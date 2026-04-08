<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPSEKAR - SMPN 5 Tangerang</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-sekolah.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-blue: #007bff;
            --bg-gradient: linear-gradient(135px, #6a11cb 0%, #2575fc 100%);
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: rgb(41, 117, 231);
            margin: 0;
            overflow-x: hidden;
        }

        /* Navbar transparan seperti di gambar dashboard */
        .navbar {
            background: rgb(41, 117, 231);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgb(41, 117, 231);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        /* Hero Section */
        .hero-container {
            padding-top: 150px;
            padding-bottom: 80px;
        }

        /* Card bergaya Dashboard Admin/Siswa Anda */
        .card-custom {
            background: white;
            border-radius: 12px;
            border: none;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            color: #333;
        }

        .card-header-blue {
            background-color: var(--primary-blue);
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        /* Tombol Masuk identik dengan gambar login */
        .btn-masuk {
            background-color: var(--primary-blue);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-masuk:hover {
            background-color: #0056b3;
            color: white;
            transform: translateY(-2px);
        }

        /* Ikon Fitur */
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            background: #ffc107;
            color: white;
        }

        footer {
            background: rgba(0,0,0,0.2);
            padding: 20px 0;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                LAPSEKAR - SMPN 5 TANGERANG
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-light btn-sm fw-bold px-4 py-2" style="color: var(--primary-blue); border-radius: 20px;">
                    LOG IN
                </a>
            </div>
        </div>
    </nav>

    <div class="container hero-container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h4 class="text-uppercase fw-bold mb-2" style="letter-spacing: 2px; color: #368eeb;">Layanan Pengaduan</h4>
                <h1 class="display-3 fw-bold mb-4">LAPSEKAR</h1>
                <p class="lead mb-5" style="opacity: 0.9;">
                    Sampaikan aspirasi dan laporan kerusakan sarana prasarana sekolah demi kenyamanan belajar mengajar di SMPN 5 Tangerang.
                </p>
                <a href="{{ route('login') }}" class="btn-masuk shadow-lg">
                    MULAI MELAPOR <i class="fas fa-paper-plane ms-2"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="card-custom">
                    <div class="card-header-blue text-uppercase">
                        <i class="fas fa-list-ul me-2"></i> Aspirasi Terbaru
                    </div>
                    <div class="p-4">
                        <div class="d-flex align-items-start mb-4 border-bottom pb-3">
                            <div class="me-3">
                                <div class="bg-light p-3 rounded-circle text-primary">
                                    <i class="fas fa-laptop-code fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold me-2">Laboratorium Komputer</h6>
                                    <span class="status-badge">Menunggu</span>
                                </div>
                                <p class="small text-muted mb-0">"Ada kabel yang hampir putus di bagian tengah..."</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <div class="bg-light p-3 rounded-circle text-primary">
                                    <i class="fas fa-door-open fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold me-2">Ruang Kelas</h6>
                                    <span class="status-badge" style="background: #17a2b8;">Proses</span>
                                </div>
                                <p class="small text-muted mb-0">"Pintu ruang 28 tidak bisa dikunci dari luar..."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="card-custom p-4">
                    <i class="fas fa-users feature-icon"></i>
                    <h3 class="fw-bold">11+</h3>
                    <p class="text-muted mb-0">Siswa Terdaftar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-4">
                    <i class="fas fa-envelope-open-text feature-icon"></i>
                    <h3 class="fw-bold">2</h3>
                    <p class="text-muted mb-0">Aspirasi Masuk</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-4">
                    <i class="fas fa-check-circle feature-icon" style="color: #28a745;"></i>
                    <h3 class="fw-bold">9</h3>
                    <p class="text-muted mb-0">Kategori Sarana</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">Sistem Pengaduan Sarana Sekolah SMPN 5 Tangerang v1.0</p>
            <p class="small text-white-50">© 2026 SMPN 5 Tangerang. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
