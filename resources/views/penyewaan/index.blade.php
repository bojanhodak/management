<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penyewaan - Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Rental System</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">← Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Data Transaksi Penyewaan</h3>
            <a href="{{ route('penyewaan.create') }}" class="btn btn-primary">+ Tambah Transaksi Sewa</a>
        </div>

        <!-- Alert Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Search & Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('penyewaan.index') }}" method="GET" class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Cari Kode TRX atau Nama Pelanggan..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Disewa" {{ request('status') == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                            <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-secondary w-100">Cari / Filter</button>
                        <a href="{{ route('penyewaan.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Kode TRX</th>
                                <th>Pelanggan</th>
                                <th>Barang / Alat</th>
                                <th>Jumlah</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th class="text-center">Aksi & Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyewaans as $item)
                                <tr>
                                    <td><strong>{{ $item->kode_transaksi }}</strong></td>
                                    <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->tgl_sewa }}</td>
                                    <td>{{ $item->tgl_kembali }}</td>
                                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($item->status == 'Diproses') bg-warning text-dark
                                            @elseif($item->status == 'Disewa') bg-primary
                                            @elseif($item->status == 'Dikembalikan') bg-info text-dark
                                            @else bg-success @endif">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                    <!-- Kolom Aksi -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            
                                            <!-- Form Quick Update Status (Admin & Staff) -->
                                            @if(in_array(auth()->user()->role, ['Administrator', 'Staff']))
                                                <form action="{{ route('penyewaan.updateStatus', $item->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm w-auto d-inline" onchange="this.form.submit()">
                                                        <option value="Diproses" {{ $item->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                        <option value="Disewa" {{ $item->status == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                                                        <option value="Dikembalikan" {{ $item->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                                        <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                    </select>
                                                </form>

                                                <!-- Tombol Edit -->
                                                <a href="{{ route('penyewaan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('penyewaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin menghapus transaksi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            @else
                                                <span class="text-muted fs-7">Read Only</span>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">Belum ada data transaksi penyewaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $penyewaans->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>