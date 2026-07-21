@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pelanggan</h5>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-light btn-sm">+ Tambah Pelanggan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $key => $pelanggan)
                        <tr>
                            <td>{{ $pelanggans->firstItem() + $key }}</td>
                            <td class="fw-bold">{{ $pelanggan->nama }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $pelanggans->links() }}
        </div>
    </div>
</div>
@endsection