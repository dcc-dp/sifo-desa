<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_users', ['only' => ['index', 'show']]);
        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
    }

    public function index()
    {
        $query = User::latest();

        // Sembunyikan akun ber-role Super Admin jika pengguna yang login bukan Super Admin
        if (!auth()->user()->hasRole('Super Admin')) {
            $query->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Super Admin');
            });
        }

        $users = $query->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $rolesQuery = Role::query();
        
        // Sembunyikan role Super Admin dari pilihan opsi role jika pengguna yang login bukan Super Admin
        if (!auth()->user()->hasRole('Super Admin')) {
            $rolesQuery->where('name', '!=', 'Super Admin');
        }

        $roles = $rolesQuery->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Proteksi: Mencegah pengguna non-Super Admin menetapkan role Super Admin
        if ($request->role === 'Super Admin' && !auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Anda tidak diizinkan membuat akun dengan role Super Admin.');
        }

        $request->validate([
            'nik_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'nik_id' => $request->nik_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Proteksi: Mencegah pengguna non-Super Admin mengedit akun Super Admin
        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit akun Super Admin.');
        }

        $rolesQuery = Role::query();
        if (!auth()->user()->hasRole('Super Admin')) {
            $rolesQuery->where('name', '!=', 'Super Admin');
        }
        $roles = $rolesQuery->get();

        $userRole = $user->roles->pluck('name')->first();

        return view('admin.user.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Proteksi: Mencegah pengguna non-Super Admin mengupdate akun Super Admin
        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah akun Super Admin.');
        }

        if ($request->role === 'Super Admin' && !auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Anda tidak diizinkan menetapkan role Super Admin.');
        }

        $request->validate([
            'nik_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'nik_id' => $request->nik_id,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Proteksi: Mencegah pengguna non-Super Admin menghapus akun Super Admin
        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Anda tidak diizinkan menghapus akun Super Admin.');
        }

        $user->delete();

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil dihapus');
    }
}