<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Rental System</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Laporan Transaksi Penyewaan</h3>
            <button onclick="window.print()" class="btn btn-secondary">Cetak / Print</button>
        </div>

        <!-- Form Filter Tanggal -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label font-weight-bold">Dari Tanggal</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label font-weight-bold">Sampai Tanggal</label>
                        <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter Laporan</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ringkasan Pendapatan -->
        <div class="card border-0 shadow-sm bg-success text-white mb-4">
            <div class="card-body p-4">
                <h5 class="mb-1">Total Pendapatan</h5>
                <h2 class="fw-bold mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode TRX</th>
                                <th>Pelanggan</th>
                                <th>Barang / Alat</th>
                                <th>Jumlah</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyewaans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $item->kode_transaksi }}</strong></td>
                                    <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->tgl_sewa }}</td>
                                    <td>{{ $item->tgl_kembali }}</td>
                                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($item->status == 'Diproses') bg-warning
                                            @elseif($item->status == 'Disewa') bg-primary
                                            @elseif($item->status == 'Dikembalikan') bg-info
                                            @else bg-success @endif">
                                            {{ $item->status }}
                                        </span>
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
    </div>

</body>
</html>