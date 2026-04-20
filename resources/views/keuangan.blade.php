<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold text-dark">💰 Dompet Digital Saya</h2>
    
    <div class="card bg-primary text-white mb-4">
        <div class="card-body text-center">
            <p class="mb-1">Total Saldo Saat Ini:</p>
            <h2 class="fw-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <h5 class="mb-3 fw-bold">Tambah Transaksi Baru</h5>
        <form action="/keuangan/tambah" method="POST" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label text-muted small">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Beli Makan" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Jenis</label>
                <select name="jenis" class="form-select">
                    <option value="masuk">Uang Masuk</option>
                    <option value="keluar">Uang Keluar</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" placeholder="0" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>
    </div>

    <div class="card p-3">
        <h5 class="mb-3 fw-bold">Riwayat Transaksi</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->keterangan }}</td>
                        <td>
                            @if($item->jenis == 'masuk')
                                <span class="badge bg-success">MASUK</span>
                            @else
                                <span class="badge bg-danger">KELUAR</span>
                            @endif
                        </td>
                        <td class="{{ $item->jenis == 'masuk' ? 'text-success' : 'text-danger' }} fw-bold">
                            {{ $item->jenis == 'masuk' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <a href="/keuangan/hapus/{{ $item->id }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>