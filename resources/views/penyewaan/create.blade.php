<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Rental System</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('penyewaan.index') }}" class="btn btn-outline-light btn-sm me-2">← Kembali ke Data Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Tambah Transaksi Penyewaan</h5>
                    </div>
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('penyewaan.store') }}" method="POST">
                            @csrf

                            <!-- Kode Transaksi (Otomatis) -->
                            <div class="mb-3">
                                <label class="form-label">Kode Transaksi</label>
                                <input type="text" name="kode_transaksi" class="form-control" value="TRX-{{ time() }}" readonly>
                            </div>

                            <!-- Pilih Pelanggan -->
                            <div class="mb-3">
                                <label class="form-label">Pelanggan</label>
                                <select name="pelanggan_id" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggan as $item)
                                        <option value="{{ $item->id }}" {{ old('pelanggan_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }} ({{ $item->telepon }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Barang/Alat -->
<div class="mb-3">
    <label class="form-label">Alat / Barang</label>
    <select name="barang_id" id="barang_id" class="form-select" required>
        <option value="">-- Pilih Alat --</option>
        @foreach($barang as $item)
            {{-- Menggunakan $item->harga alih-alih $item->harga_sewa --}}
            <option value="{{ $item->id }}" 
                    data-harga="{{ $item->harga ?? $item->harga_sewa ?? 0 }}" 
                    data-stok="{{ $item->stok }}">
                {{ $item->nama_barang }} — Rp {{ number_format($item->harga ?? $item->harga_sewa ?? 0, 0, ',', '.') }}/hari (Stok: {{ $item->stok }})
            </option>
        @endforeach
    </select>
</div>

                            <!-- Jumlah -->
                            <div class="mb-3">
                                <label class="form-label">Jumlah Unit</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
                            </div>

                            <!-- Tanggal Sewa & Kembali -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Sewa</label>
                                    <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                </div>
                            </div>

                            <!-- Total Harga Estimasi -->
                            <div class="mb-4 p-3 bg-light rounded border">
                                <label class="form-label fw-bold text-muted mb-0">Estimasi Total Biaya</label>
                                <h3 class="fw-bold text-success mb-0" id="display_total">Rp 0</h3>
                                <input type="hidden" name="total_harga" id="total_harga" value="0">
                            </div>

                            <!-- Status Awal -->
                            <input type="hidden" name="status" value="Diproses">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('penyewaan.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Hitung Biaya Otomatis -->
    <script>
        const barangSelect = document.getElementById('barang_id');
        const jumlahInput = document.getElementById('jumlah');
        const tglSewaInput = document.getElementById('tgl_sewa');
        const tglKembaliInput = document.getElementById('tgl_kembali');
        const displayTotal = document.getElementById('display_total');
        const totalHargaHidden = document.getElementById('total_harga');

        function hitungTotal() {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const hargaSewa = selectedOption ? parseFloat(selectedOption.getAttribute('data-harga')) || 0 : 0;
            const jumlah = parseInt(jumlahInput.value) || 1;

            const tglSewa = new Date(tglSewaInput.value);
            const tglKembali = new Date(tglKembaliInput.value);

            let diffDays = 1;
            if (tglSewa && tglKembali && tglKembali >= tglSewa) {
                const diffTime = Math.abs(tglKembali - tglSewa);
                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays === 0) diffDays = 1; // Minimal sewa 1 hari
            }

            const total = hargaSewa * jumlah * diffDays;
            displayTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
            totalHargaHidden.value = total;
        }

        barangSelect.addEventListener('change', hitungTotal);
        jumlahInput.addEventListener('input', hitungTotal);
        tglSewaInput.addEventListener('change', hitungTotal);
        tglKembaliInput.addEventListener('change', hitungTotal);
    </script>
    document.addEventListener('DOMContentLoaded', function() {
    hitungTotal();
});
</body>
</html>