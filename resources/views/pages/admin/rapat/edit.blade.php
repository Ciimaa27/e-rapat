@extends('layouts.app-tailwind')

@section('title', 'Edit Pengguna - E-Notulen')

@section('content')
<h1 class="text-2xl font-extrabold text-brand-green mb-4">Edit Pengguna</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST"
      class="space-y-4 bg-white p-4 rounded shadow">
    @csrf
    @method('PUT')

    {{-- sama seperti create, hanya value diisi dari $user --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"
               class="mt-1 w-full border rounded px-3 py-2">
        @error('name') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"
               class="mt-1 w-full border rounded px-3 py-2">
        @error('email') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700">Peran</label>
        <select name="role" class="mt-1 w-full border rounded px-3 py-2">
            @php $role = old('role', $user->role); @endphp
            <option value="pegawai" {{ $role == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="notulis" {{ $role == 'notulis' ? 'selected' : '' }}>Notulis</option>
            <option value="pimpinan" {{ $role == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
        </select>
        @error('role') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700">
            Password (kosongkan jika tidak diganti)
        </label>
        <input type="password" name="password"
               class="mt-1 w-full border rounded px-3 py-2">
        @error('password') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
               class="mt-1 w-full border rounded px-3 py-2">
    </div>

    <button type="submit"
            class="bg-brand-green text-white px-4 py-2 rounded font-semibold">
        Update
    </button>
</form>
@endsection
