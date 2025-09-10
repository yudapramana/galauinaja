<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SIGARDA — Gerbang Arsip Digital Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Tema hijau + compact */
        .navbar {
            padding-top: .45rem;
            padding-bottom: .45rem;
        }

        .hero {
            background: linear-gradient(180deg, #f0fff4 0%, #ffffff 100%);
            border-bottom: 1px solid #eaf2ec;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-lead {
            font-size: 1rem;
            color: #49624f;
        }

        .pill {
            display: inline-block;
            padding: .25rem .6rem;
            border-radius: 50rem;
            background: #eaf7ee;
            color: #198754;
            font-weight: 600;
            font-size: .85rem;
            margin: .15rem .25rem 0 0;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .card-body {
            padding: 1rem;
        }

        .feature-emoji {
            font-size: 1.75rem;
        }

        footer a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="/">SIGARDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-success btn-sm" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero (tanpa tombol panduan) -->
    <section class="hero py-5 text-center">
        <div class="container">
            <h1 class="hero-title fw-bold mb-2">SIGARDA</h1>
            <p class="hero-lead mb-3">
                Sistem Informasi Gerbang Arsip Digital Pegawai<br />
                Kementerian Agama Kabupaten Pesisir Selatan
            </p>
            <div class="mb-3">
                <span class="pill">Aman</span>
                <span class="pill">Terpadu</span>
                <span class="pill">Transparan</span>
            </div>
            <a href="/login" class="btn btn-success btn-sm mt-2">Masuk Sistem</a>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="about" class="py-4">
        <div class="container">
            <h2 class="section-title text-center mb-3">Tentang SIGARDA</h2>
            <p class="text-center mb-0">
                SIGARDA merupakan platform digitalisasi arsip kepegawaian yang dirancang untuk mempermudah proses unggah,
                pencarian, dan verifikasi dokumen bagi ASN di lingkungan Kemenag Pesisir Selatan.
            </p>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="features" class="py-4 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-3">Fitur Unggulan</h2>
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="feature-emoji text-success mb-2">📁</div>
                            <h6 class="mb-1">Manajemen Arsip</h6>
                            <p class="small mb-0">Kelola dokumen digital Anda dengan mudah dan efisien.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="feature-emoji text-success mb-2">🔍</div>
                            <h6 class="mb-1">Pencarian Cepat</h6>
                            <p class="small mb-0">Temukan dokumen berdasarkan NIP atau jenis dokumen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="feature-emoji text-success mb-2">✅</div>
                            <h6 class="mb-1">Verifikasi Dokumen</h6>
                            <p class="small mb-0">Lihat status validasi dokumen dari admin instansi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="feature-emoji text-success mb-2">📤</div>
                            <h6 class="mb-1">Upload Aman</h6>
                            <p class="small mb-0">Sistem mendukung validasi dan keamanan unggahan dokumen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="feature-emoji text-success mb-2">📜</div>
                            <h6 class="mb-1">Riwayat Akses</h6>
                            <p class="small mb-0">Pantau histori akses dokumen secara transparan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="contact" class="py-4">
        <div class="container">
            <h2 class="section-title text-center mb-3">Kontak</h2>
            <p class="text-center mb-1">Untuk bantuan teknis dan informasi lebih lanjut, hubungi:</p>
            <p class="text-center mb-0">
                📧 Email: <a href="mailto:pessel@kemenag.go.id">pessel@kemenag.go.id</a>
                &nbsp;•&nbsp; 📱 WA: 0896-7754-2744
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-success text-white">
        <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-2">
            <p class="mb-0 small">&copy; 2025 SIGARDA — Kementerian Agama Kabupaten Pesisir Selatan</p>
            <nav class="mb-0 d-flex gap-3 small">
                <a class="text-white text-decoration-underline" href="/privacy-policy">Kebijakan Privasi</a>
                <a class="text-white text-decoration-underline" href="/terms-of-service">Syarat dan Ketentuan</a>
                <a class="text-white text-decoration-underline" href="/#about">Tentang</a>
                <a class="text-white text-decoration-underline" href="/#features">Fitur</a>
                <a class="text-white text-decoration-underline" href="/#contact">Kontak</a>
            </nav>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
