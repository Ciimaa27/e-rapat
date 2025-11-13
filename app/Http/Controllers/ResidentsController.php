<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentsController extends Controller
{
    public function index()
    {
        $residents = Resident::all();

        return view('pages.residents.index', [
            'residents' => $residents,
        ]);
    }

    public function create()
    {
        return view('pages.residents.create');
    }

    public function store(Request $request)
    {
        // validasi data
        $validated = $request->validate([
            'name'           => ['required', 'max:100'],
            'nik'            => ['required', 'min:16', 'max:16'],
            'gender'         => ['required', Rule::in(['Male', 'Female'])],
            'birth_date'     => ['required', 'string'],
            'birth_place'    => ['required', 'max:100'],
            'address'        => ['required', 'max:700'],
            'religion'       => ['nullable', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation'     => ['nullable', 'max:100'],
            'phone'          => ['nullable', 'max:15'],
            'status'         => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        // simpan ke database
        Resident::create($validated);

        // kembali ke index dengan pesan sukses
        return redirect()->route('residents.index')
            ->with('success', 'Berhasil menambahkan data.');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        return view('pages.residents.create', [
            'resident' => $resident,
        ]);
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $validated = $request->validate([
            'name'           => ['required', 'max:100'],
            'nik'            => ['required', 'min:16', 'max:16'],
            'gender'         => ['required', Rule::in(['Male', 'Female'])],
            'birth_date'     => ['required', 'string'],
            'birth_place'    => ['required', 'max:100'],
            'address'        => ['required', 'max:700'],
            'religion'       => ['nullable', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation'     => ['nullable', 'max:100'],
            'phone'          => ['nullable', 'max:15'],
            'status'         => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        $resident->update($validated);

        return redirect()->route('residents.index')
            ->with('success', 'Berhasil mengubah data.');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('residents.index')
            ->with('success', 'Berhasil menghapus data.');
    }
}

