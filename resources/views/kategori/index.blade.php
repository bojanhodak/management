@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
<div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kategori</h5>
        <a href="{{ route('kategori.create') }}" class="btn btn-light btn-sm">+ Tambah Kategori</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Total Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $key => $kategori)
                        <tr>
                            <td>{{ $kategoris->firstItem() + $key }}</td>
                            <td class="fw-bold">{{ $kategori->nama_kategori }}</td>
                            <td>{{ $kategori->deskripsi ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $kategori->barangs_count }} Produk
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection