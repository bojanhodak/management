@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Edit Kategori</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection