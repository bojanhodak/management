@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Edit Data Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small></label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru jika ingin diganti">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection