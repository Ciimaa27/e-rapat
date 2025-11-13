<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // sementara dummy data dulu:
        $users = [
            (object)[ 'id' => 1, 'name' => 'Ahmad Arya Saloka', 'email' => 'aryasalokaadmin@notulen.id', 'role' => 'admin' ],
            (object)[ 'id' => 2, 'name' => 'Radita Nabila Shofa', 'email' => 'nabilapegawai@notulen.id', 'role' => 'pegawai' ],
            (object)[ 'id' => 3, 'name' => 'Ismatul Hawa', 'email' => 'ismatulhawaadmin@notulen.id', 'role' => 'admin' ],
        ];

        return view('pages.residents.data-pengguna', compact('users'));
    }

    public function create()
    {
        // halaman form tambah akun
        return view('pages.residents.create-akun');
    }

    public function store(Request $request)
    {
        // nanti kalau sudah ada tabel users + kolom role/status, tinggal isi logic simpan di sini.
        // sementara kita validasi ringan lalu balik ke index saja.

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'role'     => 'required',
            'status'   => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // TODO: simpan ke database
        // User::create([...]);

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil diajukan (dummy, belum tersimpan ke DB).');
    }

    public function edit($id)
    {
        // nanti isinya form edit
    }

    public function destroy($id)
    {
        // nanti isinya hapus data
    }
}
