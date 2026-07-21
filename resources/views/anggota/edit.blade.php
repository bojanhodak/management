@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Edit Data Anggota</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $anggota->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>

            <div class="mb-3">
                <label class="form-label">Role / Hak Akses</label>
                <select name="role" class="form-select" required>
                    <option value="Customer" {{ old('role', $anggota->role) == 'Customer' ? 'selected' : '' }}>Customer</option>
                    <option value="Staff" {{ old('role', $anggota->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                    <option value="Administrator" {{ old('role', $anggota->role) == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection