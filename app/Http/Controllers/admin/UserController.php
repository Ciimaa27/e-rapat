<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // bisa tambahin orderBy biar rapi
        $users = User::orderBy('name')->get();
        return view('pages.admin.rapat.data-pengguna', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.rapat.create-akun');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required',
            'password' => 'required|min:3',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'role'     => strtolower($validated['role']),   // 👈 disimpan huruf kecil
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.rapat.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required',
            'password' => 'nullable|min:3'
        ]);

        $user = User::findOrFail($id);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = strtolower($validated['role']);   // 👈 konsisten huruf kecil

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }

    // REALTIME SEARCH
    public function search(Request $request)
    {
        $q = $request->q;

        $users = User::where('name', 'LIKE', "%$q%")
                    ->orWhere('email', 'LIKE', "%$q%")
                    ->orWhere('role', 'LIKE', "%$q%")
                    ->orderBy('name')
                    ->get(['id', 'name', 'email', 'role']); // cukup ambil field yg dipakai

        return response()->json($users);
    }
}
