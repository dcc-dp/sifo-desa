<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nik_id' => $request->nik_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nik_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
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

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.user-index')
            ->with('success', 'User berhasil dihapus');
    }
}