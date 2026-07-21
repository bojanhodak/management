@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Pelanggan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Masukkan nama pelanggan">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="contoh@email.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Pelanggan</button>
            </div>
        </form>
    </div>
</div>
@endsection