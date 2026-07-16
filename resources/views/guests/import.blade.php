<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data Tamu - The Wedding Portrait</title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8f6fc;
            min-height: 100vh;
        }
        h1, h2, .wedding-title {
            font-family: 'Playfair Display', serif;
            color: #4a287a;
        }
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 2px solid #f1ebfa !important;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #4a287a !important;
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
            transform: translateY(-2px);
        }
        .form-control:focus {
            border-color: #c0b3f2;
            box-shadow: 0 0 0 0.25rem rgba(127, 90, 240, 0.15);
        }
        .alert-purple {
            background-color: #f4f0fa;
            border: 1px solid #e1d3fc;
            color: #4a287a;
        }
        /* Style box upload */
        .upload-box {
            border: 2px dashed #c0b3f2;
            background: #faf9fe;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3 mb-5 shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand fs-4 text-decoration-none">
                <i class="fa-solid fa-heart me-2" style="color: #7f5af0;"></i>The Wedding Portrait
            </a>
            <div class="d-flex align-items-center gap-2">
                <a href="/" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Portal
                </a>
                <span class="badge p-2 rounded-3" style="background-color: #f4f0fa; color: #4a287a; border: 1px solid #e1d3fc;">
                    <i class="fa-solid fa-file-import me-1"></i> Import Guests
                </span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        
        <!-- HEADER -->
        <div class="text-center mb-5">
            <p class="text-uppercase tracking-wider text-muted mb-1" style="font-size: 0.8rem; letter-spacing: 2px;">Admin Desk</p>
            <h1 class="display-5 fw-bold">Import Data Tamu</h1>
            <p class="text-muted">Unggah daftar tamu undangan secara massal menggunakan file Excel (.xlsx atau .xls).</p>
        </div>

        <!-- NOTIFIKASI HASIL IMPORT -->
        @if(session('success'))
            <div class="alert alert-purple border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-xmark fs-4 me-3 text-danger"></i>
                <div>
                    <strong>Gagal!</strong> {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- PANEL INPUT FILE -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <div class="upload-box p-4 mb-3 d-inline-block">
                            <i class="fa-solid fa-file-excel display-4" style="color: #7f5af0;"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Pilih File Excel</h5>
                        <p class="text-muted small">Format kolom di file Excel kamu wajib sesuai dengan urutan: <strong>Nama, Kuota Undangan, Kategori, No. Meja</strong>.</p>
                    </div>

                    <!-- FORM PROSES IMPORT -->
                    <form action="{{ route('guests.import.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold text-muted small">UPLOAD FILE EXCEL (.XLSX / .XLS)</label>
                            <input type="file" name="file" id="file" class="form-control form-control-lg" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-purple btn-lg w-100 fw-bold py-3 shadow-sm">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i>Mulai Import Data
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</body>
</html>