@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Barang</h5>
        <a href="{{ route('barang.create') }}" class="btn btn-dark btn-sm">+ Tambah Barang</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $key => $barang)
                        <tr>
                            <td>{{ $barangs->firstItem() + $key }}</td>
                            <td class="fw-bold">{{ $barang->nama_barang }}</td>
                            <td><span class="badge bg-secondary">{{ $barang->kategori->nama_kategori ?? '-' }}</span></td>
                            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $barangs->links() }}
        </div>
    </div>
</div>
@endsection