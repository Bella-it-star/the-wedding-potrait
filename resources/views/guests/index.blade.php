<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usher Portal - Wedding Guest</title>
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

        .badge-vip {
            background-color: #4a287a;
            color: #ffffff;
            font-weight: 600;
        }
        .badge-reguler {
            background-color: #f1ebfa;
            color: #7f5af0;
            font-weight: 600;
        }
        .badge-hadir {
            background-color: #e8e3f5;
            color: #583ba3;
            font-weight: 600;
        }
        .badge-belum-hadir {
            background-color: #ffffff;
            color: #a084dc;
            border: 1px solid #e1d3fc;
            font-weight: 600;
        }

        .table-purple-head {
            background-color: #f4f0fa !important;
            color: #4a287a;
        }
        .table-hover tbody tr:hover {
            background-color: #faf9fe;
        }

        .form-control:focus {
            border-color: #c0b3f2;
            box-shadow: 0 0 0 0.25rem rgba(127, 90, 240, 0.15);
        }

        /* Tampilan Kupon di Layar HP/Laptop */
        .ticket-box {
            border: 3px dashed #7f5af0;
            border-radius: 12px;
            background: #faf9ff;
            position: relative;
            overflow: hidden;
        }

        /* PENGATURAN KHUSUS UTK PRINTER STRUK/KUPON KECIL */
        @media print {
            @page { 
                margin: 0; 
            }
            body { 
                margin: 0;
                background: #fff;
                padding: 0;
            }
            body * {
                visibility: hidden;
            }
            .modal.show, .modal.show * {
                visibility: visible;
            }
            .modal.show {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .modal-content {
                border: none !important;
                box-shadow: none !important;
                background: #fff !important;
            }
            .modal-header, .modal-footer, p.text-muted {
                display: none !important;
            }
            .modal-body {
                padding: 5mm !important;
                width: 100% !important;
            }
            .ticket-box {
                width: 95% !important;
                max-width: 95% !important;
                margin: 0 auto 8mm auto !important;
                border: 2px dashed #000 !important;
                background: #fff !important;
                box-shadow: none !important;
                padding: 15px !important;
                page-break-after: always !important;
                break-after: page !important;
            }
            .ticket-box h4 {
                color: #000 !important;
                font-size: 1.8rem !important;
                font-weight: bold !important;
            }
            .ticket-box .text-dark {
                color: #000 !important;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3 mb-5 shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand fs-4 text-decoration-none">
                <i class="fa-solid fa-heart text-purple me-2" style="color: #7f5af0;"></i>The Wedding Portrait
            </a>
            <div class="d-flex align-items-center">
                <span class="badge p-2 rounded-3" style="background-color: #f4f0fa; color: #4a287a; border: 1px solid #e1d3fc;">
                    <i class="fa-solid fa-user-tie me-1"></i> Usher Mode
                </span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        
        <!-- HEADER PORTAL -->
        <div class="text-center mb-5">
            <p class="text-uppercase tracking-wider text-muted mb-1" style="font-size: 0.8rem; letter-spacing: 2px;">Receptionist Desk</p>
            <h1 class="display-5 fw-bold">Daftar Kehadiran Tamu</h1>
            <p class="text-muted">Kelola check-in tamu undangan dan cetak tiket souvenir secara real-time.</p>
        </div>

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert alert-purple border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" style="background-color: #e8e3f5; color: #4a287a;" role="alert">
                <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <!-- AREA UTAMA -->
        <div class="card card-custom p-4 mb-5">
            
            <!-- FORM PENCARIAN & TOMBOL TAMBAH TAMU -->
            <form action="{{ route('guests.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="q" class="form-control bg-light border-start-0" placeholder="Cari berdasarkan nama tamu undangan..." value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-purple w-100 fw-bold">
                        <i class="fa-solid fa-filter me-2"></i>Cari
                    </button>
                </div>
                <!-- FITUR TAMBAH DATA (CREATE) -->
                <div class="col-md-3">
                    <a href="{{ route('guests.create') }}" class="btn btn-success w-100 fw-bold rounded-3 shadow-sm">
                        <i class="fa-solid fa-user-plus me-2"></i>Tambah Tamu
                    </a>
                </div>
            </form>

            <!-- TABEL TAMU -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="table-purple-head" style="font-size: 0.9rem;">
                            <th class="py-3 ps-3">NAMA TAMU</th>
                            <th class="text-center py-3">KUOTA</th>
                            <th class="py-3">KATEGORI</th>
                            <th class="text-center py-3">NO. MEJA</th>
                            <th class="py-3">STATUS KEHADIRAN</th>
                            <th class="text-center py-3 pe-3">AKSI KELOLA TAMU</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guests as $guest)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">{{ $guest->name }}</div>
                                    <small class="text-muted"><i class="fa-solid fa-id-badge me-1"></i>ID: G-{{ $guest->id }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1.5 fs-7"><i class="fa-solid fa-users me-1 text-muted"></i>{{ $guest->invited_count }} pax</span>
                                </td>
                                <td>
                                    @if(strtolower($guest->category) == 'vip')
                                        <span class="badge badge-vip px-3 py-2 rounded-pill"><i class="fa-solid fa-crown me-1 text-warning"></i>VIP</span>
                                    @else
                                        <span class="badge badge-reguler px-3 py-2 rounded-pill">{{ $guest->category ?? 'Reguler' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark bg-opacity-75 text-white px-2.5 py-1.5 rounded">{{ $guest->table_number ?? '-' }}</span>
                                </td>
                                <td>
                                    @if($guest->checkin)
                                        <span class="badge badge-hadir px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1" style="color: #7f5af0;"></i>Hadir ({{ $guest->checkin->attended_count }} pax)
                                        </span>
                                    @else
                                        <span class="badge badge-belum-hadir px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-clock me-1"></i>Belum Datang
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        @if(!$guest->checkin)
                                            <!-- BELUM CHECK-IN -->
                                            <form action="{{ route('guests.checkin', $guest->id) }}" method="POST" class="d-flex gap-2 m-0">
                                                @csrf
                                                <div class="input-group input-group-sm" style="width: 90px;">
                                                    <span class="input-group-text"><i class="fa-solid fa-user-plus text-muted"></i></span>
                                                    <input type="number" name="attended_count" class="form-control text-center fw-bold" min="1" max="{{ $guest->invited_count }}" value="1" required>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-purple px-2.5 rounded-3 fw-bold">
                                                    Check-in
                                                </button>
                                            </form>
                                        @else
                                            <!-- SUDAH CHECK-IN -> TOMBOL CETAK -->
                                            <button class="btn btn-sm btn-light border text-muted px-2" disabled>
                                                <i class="fa-solid fa-circle-check text-success me-1"></i>Hadir
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning text-white fw-bold px-2.5 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTiket{{ $guest->id }}">
                                                <i class="fa-solid fa-print me-1"></i>Cetak
                                            </button>
                                        @endif

                                        <!-- FITUR UPDATE (EDIT) -->
                                        <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-sm btn-outline-warning rounded-3" title="Edit Data Tamu">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- FITUR DELETE (HAPUS) -->
                                        <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="d-inline mb-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $guest->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Hapus Tamu">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- POP-UP MODAL KUPON (Hanya merender jika sudah checkin) -->
                                    @if($guest->checkin)
                                        <div class="modal fade" id="modalTiket{{ $guest->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content rounded-4 border-0 shadow">
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="modal-title fw-bold text-dark">
                                                            <i class="fa-solid fa-ticket text-purple me-2" style="color: #7f5af0;"></i>Tiket Kupon Souvenir
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body py-4">
                                                        <p class="text-muted small text-center mb-4">Silakan potong tiket di bawah ini untuk ditukarkan di meja souvenir.</p>
                                                        
                                                        <div class="d-flex flex-column align-items-center gap-4">
                                                            @foreach($guest->souvenirTickets as $ticket)
                                                                <div class="ticket-box p-4 bg-white shadow-sm w-100" style="max-width: 280px; text-align: center;">
                                                                    <div class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Souvenir Ticket</div>
                                                                    <h4 class="fw-bold my-2" style="color: #7f5af0;">{{ $ticket->ticket_code }}</h4>
                                                                    <div class="border-top my-3" style="border-top: 1px dashed #e1d3fc !important;"></div>
                                                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $guest->name }}</div>
                                                                    <small class="text-muted" style="color: #a084dc !important;"><i class="fa-solid fa-check-to-slot me-1"></i>Verified Usher</small>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0 justify-content-center">
                                                        <button onclick="window.print()" class="btn btn-purple px-4 py-2 rounded-3 fw-bold shadow-sm">
                                                            <i class="fa-solid fa-print me-2"></i>Cetak Sekarang
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-folder-open display-6 mb-3 text-muted"></i>
                                    <p class="mb-0">Data tamu tidak ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>