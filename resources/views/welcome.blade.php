<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding Portrait - Portal Utama</title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #fbfaff 0%, #f3edf9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        h1, .brand-title {
            font-family: 'Playfair Display', serif;
            color: #4a287a;
        }
        .card-portal {
            border: none;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(74, 40, 122, 0.08);
            background: #ffffff;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .hero-section {
            background: linear-gradient(135deg, #7f5af0 0%, #6a46db 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }
        .menu-card {
            border: 1px solid #f1ebfa;
            border-radius: 16px;
            transition: all 0.3s ease;
            background-color: #ffffff;
            text-decoration: none;
            color: inherit;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(127, 90, 240, 0.12);
            border-color: #c0b3f2;
            color: #4a287a;
        }
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background-color: #f4f0fa;
            color: #7f5af0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        .menu-card:hover .icon-box {
            background-color: #7f5af0;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="container p-3">
        <div class="card card-portal mx-auto">
            
            <!-- HEADER -->
            <div class="hero-section position-relative">
                <div class="mb-2"><i class="fa-solid fa-heart-pulse fs-1 text-warning"></i></div>
                <h1 class="text-white fw-bold mb-2">The Wedding Portrait</h1>
                <p class="lead mb-0 text-white-50" style="font-size: 1.1rem;">Sistem Manajemen Tamu & Penukaran Souvenir Pernikahan</p>
            </div>

            <!-- MENU UTAMA (GATEWAY) -->
            <div class="p-4 p-md-5">
                <h5 class="text-center text-muted text-uppercase tracking-wider mb-4" style="font-size: 0.8rem; letter-spacing: 2px;">Silakan Pilih Portal Layanan</h5>
                
                <div class="row g-4">
                    
                    <!-- MENU 1: USHER / MEJA REGISTRASI -->
                    <div class="col-md-6">
                        <a href="{{ route('guests.index') }}" class="menu-card d-flex align-items-center p-4 h-100">
                            <div class="icon-box me-3">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Meja Penerima Tamu</h5>
                                <p class="text-muted small mb-0">Check-in tamu, input jumlah kehadiran, dan cetak kupon souvenir.</p>
                            </div>
                        </a>
                    </div>

                    <!-- MENU 2: MEJA SOUVENIR -->
                    <div class="col-md-6">
                        <a href="{{ route('souvenir.desk') }}" class="menu-card d-flex align-items-center p-4 h-100">
                            <div class="icon-box me-3">
                                <i class="fa-solid fa-gift"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Meja Penukaran Souvenir</h5>
                                <p class="text-muted small mb-0">Scan / validasi kode kupon tamu untuk penyerahan cinderamata.</p>
                            </div>
                        </a>
                    </div>

                    <!-- MENU 3: IMPORT DATA TAMU (ADMIN) -->
                    <div class="col-md-12">
                        <a href="{{ route('guests.import.index') }}" class="menu-card d-flex align-items-center p-4">
                            <div class="icon-box me-3">
                                <i class="fa-solid fa-file-import"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Import Data Tamu (Excel)</h5>
                                <p class="text-muted small mb-0">Halaman khusus Admin untuk mengunggah daftar list tamu undangan secara massal.</p>
                            </div>
                        </a>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="text-center mt-5 pt-3 border-top text-muted small">
                    &copy; 2026 The Wedding Portrait. Created for UAS Project.
                </div>
            </div>

        </div>
    </div>

</body>
</html>