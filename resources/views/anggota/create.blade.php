@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Tambah Anggota Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection