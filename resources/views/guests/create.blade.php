<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tamu Undangan - Wedding Guest</title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8f6fc;
            min-height: 100vh;
        }
        h2 {
            font-family: 'Playfair Display', serif;
            color: #4a287a;
        }
        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(74, 40, 122, 0.04);
            background: #ffffff;
        }
        .btn-purple {
            background-color: #7f5af0;
            color: #ffffff;
            border-radius: 8px;
            border: none;
            transition: all 0.3s;
        }
        .btn-purple:hover {
            background-color: #6a46db;
            color: #ffffff;
        }
        .form-control:focus, .form-select:focus {
            border-color: #c0b3f2;
            box-shadow: 0 0 0 0.25rem rgba(127, 90, 240, 0.15);
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <!-- TOMBOL KEMBALI -->
                <a href="{{ route('guests.index') }}" class="btn btn-sm btn-light border mb-4 text-muted fw-bold">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>

                <!-- KARTU FORM TAMBAH -->
                <div class="card card-custom p-4">
                    <h2 class="fs-3 fw-bold mb-2"><i class="fa-solid fa-user-plus me-2" style="color: #7f5af0;"></i>Tambah Tamu Baru</h2>
                    <p class="text-muted small mb-4">Masukkan data detail tamu undangan baru untuk disimpan ke database.</p>

                    <!-- Menampilkan Error jika Validasi Gagal -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 px-3 rounded-3 mb-3" style="font-size: 0.85rem;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('guests.store') }}" method="POST">
                        @csrf

                        <!-- NAMA TAMU -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark small">Nama Tamu Undangan</label>
                            <input type="text" name="name" class="form-control bg-light py-2" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso">
                        </div>

                        <div class="row">
                            <!-- KUOTA / INVITED COUNT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark small">Kuota Tamu (Pax)</label>
                                <input type="number" name="invited_count" class="form-control bg-light py-2" value="{{ old('invited_count', 2) }}" min="1" required>
                            </div>

                            <!-- NOMOR TELEPON -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark small">Nomor HP / WhatsApp</label>
                                <input type="text" name="phone" class="form-control bg-light py-2" value="{{ old('phone') }}" placeholder="Contoh: 08123456xxx">
                            </div>
                        </div>

                        <div class="row">
                            <!-- KATEGORI TAMU -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark small">Kategori</label>
                                <select name="category" class="form-select bg-light py-2">
                                    <option value="Reguler" {{ old('category') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                    <option value="VIP" {{ old('category') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="VVIP" {{ old('category') == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                                    <option value="Keluarga" {{ old('category') == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                                </select>
                            </div>

                            <!-- NOMOR MEJA -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark small">Nomor Meja</label>
                                <input type="text" name="table_number" class="form-control bg-light py-2" value="{{ old('table_number') }}" placeholder="Contoh: V-02 atau B-15">
                            </div>
                        </div>

                        <!-- CATATAN / NOTES -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small">Catatan Tambahan</label>
                            <textarea name="notes" class="form-control bg-light py-2" rows="3" placeholder="Tulis catatan di sini jika ada...">{{ old('notes') }}</textarea>
                        </div>

                        <!-- TOMBOL SUBMIT -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-purple py-2.5 fw-bold shadow-sm">
                                <i class="fa-solid fa-plus me-2"></i>Tambahkan Tamu Undangan
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</body>
</html>