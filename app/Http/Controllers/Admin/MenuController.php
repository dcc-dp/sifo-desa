<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_menus')->only(['index', 'show']);
        $this->middleware('permission:create_menus')->only(['create', 'store']);
        $this->middleware('permission:edit_menus')->only(['edit', 'update']);
        $this->middleware('permission:delete_menus')->only(['destroy']);
    }

    public function index()
    {
        // Load menus with their roles and parent
        $menus = Menu::with(['roles', 'parent' => function($q) {
            $q->select('id', 'title');
        }])->orderBy('order_num')->get();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $roles = Role::all();
        // Get only headers or top level menus as potential parents
        $parentMenus = Menu::where('is_header', true)
            ->orWhereNull('parent_id')
            ->orderBy('order_num')
            ->get();

        return view('admin.menus.create', compact('roles', 'parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'order_num' => 'required|integer',
            'parent_id' => 'nullable|exists:menus,id',
            'is_header' => 'boolean',
            'is_active' => 'boolean',
            'roles' => 'array'
        ]);

        $menu = Menu::create([
            'title' => $request->title,
            'route_name' => $request->route_name,
            'url' => $request->url,
            'icon' => $request->icon,
            'order_num' => $request->order_num,
            'parent_id' => $request->parent_id,
            'is_header' => $request->has('is_header') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        if ($request->has('roles')) {
            $menu->roles()->sync($request->roles);
        }

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $roles = Role::all();
        $parentMenus = Menu::where('id', '!=', $menu->id)
            ->where(function($query) {
                $query->where('is_header', true)
                      ->orWhereNull('parent_id');
            })
            ->orderBy('order_num')
            ->get();
            
        $menuRoles = $menu->roles->pluck('id')->toArray();

        return view('admin.menus.edit', compact('menu', 'roles', 'parentMenus', 'menuRoles'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'order_num' => 'required|integer',
            'parent_id' => 'nullable|exists:menus,id',
            'is_header' => 'boolean',
            'is_active' => 'boolean',
            'roles' => 'array'
        ]);

        $menu->update([
            'title' => $request->title,
            'route_name' => $request->route_name,
            'url' => $request->url,
            'icon' => $request->icon,
            'order_num' => $request->order_num,
            'parent_id' => $request->parent_id,
            'is_header' => $request->has('is_header') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        if ($request->has('roles')) {
            $menu->roles()->sync($request->roles);
        } else {
            $menu->roles()->sync([]);
        }

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        // Delete all child menus as well, or you can rely on the database cascade rules
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
