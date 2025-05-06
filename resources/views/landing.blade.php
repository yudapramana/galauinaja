<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGARDA - Gerbang Arsip Digital Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="#">SIGARDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#guide">Panduan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item"><a class="btn btn-success ms-3" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h1 class="display-5 fw-bold">SIGARDA</h1>
            <p class="lead">Sistem Informasi Gerbang Arsip Digital Pegawai<br>Kementerian Agama Kabupaten Pesisir Selatan</p>
            <a href="#guide" class="btn btn-outline-success me-2">Lihat Panduan</a>
            <a href="/login" class="btn btn-success">Masuk Sistem</a>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Tentang SIGARDA</h2>
            <p class="text-center">SIGARDA merupakan platform digitalisasi arsip kepegawaian yang dirancang untuk mempermudah proses unggah, pencarian, dan verifikasi dokumen bagi ASN di lingkungan Kemenag Pesisir Selatan.</p>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="display-6 text-success mb-3">📁</div>
                            <h5 class="card-title">Manajemen Arsip</h5>
                            <p class="card-text">Kelola dokumen digital Anda dengan mudah dan efisien.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="display-6 text-success mb-3">🔍</div>
                            <h5 class="card-title">Pencarian Cepat</h5>
                            <p class="card-text">Temukan dokumen berdasarkan NIP atau jenis dokumen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="display-6 text-success mb-3">✅</div>
                            <h5 class="card-title">Verifikasi Dokumen</h5>
                            <p class="card-text">Lihat status validasi dokumen dari admin instansi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="display-6 text-success mb-3">📤</div>
                            <h5 class="card-title">Upload Aman</h5>
                            <p class="card-text">Sistem mendukung validasi dan keamanan unggahan dokumen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="display-6 text-success mb-3">📜</div>
                            <h5 class="card-title">Riwayat Akses</h5>
                            <p class="card-text">Pantau histori akses dokumen secara transparan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan Section -->
    <section id="guide" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Panduan Penggunaan</h2>
            <p>Pelajari cara menggunakan SIGARDA dengan mudah melalui dokumen panduan berikut:</p>
            <a href="#" class="btn btn-outline-primary">📘 Unduh Panduan Pengguna</a>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Kontak</h2>
            <p class="text-center">Untuk bantuan teknis dan informasi lebih lanjut, hubungi:</p>
            <p class="text-center">📧 Email: <a href="mailto:support@kemenagpessel.go.id">support@kemenagpessel.go.id</a></p>
            <p class="text-center">📱 WA: 0821-xxxx-xxxx</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-success text-white text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 SIGARDA - Kementerian Agama Kabupaten Pesisir Selatan</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
