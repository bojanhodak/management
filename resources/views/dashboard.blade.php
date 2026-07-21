<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rental Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Rental System</a>
            <div class="d-flex align-items-center">
                <span class="navbar-text me-3 text-white">
                    Halo, <strong>{{ auth()->user()->nama }}</strong> ({{ auth()->user()->role }})
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Dashboard Overview</h2>
                <p class="text-muted">Selamat datang di Sistem Informasi Rental Alat.</p>
            </div>
        </div>

        <!-- Cards Metrics -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase fs-7">Total Alat</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalBarang }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase fs-7">Total Pelanggan</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalPelanggan }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-dark">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase fs-7">Sewa Aktif</h6>
                        <h2 class="mb-0 fw-bold">{{ $transaksiAktif }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase fs-7">Total Transaksi</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalPenyewaan }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Quick Links -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Navigasi Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-2 flex-wrap">
                            @if(in_array(auth()->user()->role, ['Administrator', 'Staff']))
                                <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary">Data Kategori</a>
                                <a href="{{ route('barang.index') }}" class="btn btn-outline-primary">Data Alat/Barang</a>
                                <a href="{{ route('supplier.index') }}" class="btn btn-outline-primary">Data Supplier</a>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-primary">Data Pelanggan</a>
                                <a href="{{ route('anggota.index') }}" class="btn btn-outline-primary">Data User/Anggota</a>
                                <a href="{{ route('laporan.index') }}" class="btn btn-outline-dark">Laporan</a>
                            @endif
                            <a href="{{ route('penyewaan.index') }}" class="btn btn-success">Sewa / Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>