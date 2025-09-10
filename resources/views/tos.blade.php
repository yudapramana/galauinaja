<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Syarat & Ketentuan — SIGARDA</title>
    <meta name="description" content="Syarat dan Ketentuan penggunaan SIGARDA (Sistem Informasi Gerbang Arsip Digital Pegawai) Kementerian Agama Kabupaten Pesisir Selatan." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* === Tema seragam dengan landing & privacy-policy === */
        .navbar {
            padding-top: .45rem;
            padding-bottom: .45rem;
        }

        .hero {
            background: linear-gradient(180deg, #f0fff4 0%, #ffffff 100%);
            border-bottom: 1px solid #eaf2ec;
        }

        body {
            background: #f8f9fa;
        }

        .doc-container {
            max-width: 980px;
        }

        .toc a {
            text-decoration: none;
        }

        .toc .active {
            font-weight: 600;
        }

        .doc h2,
        .doc h3 {
            scroll-margin-top: 90px;
        }

        @media print {

            nav,
            .toc,
            .btn,
            .alert,
            footer {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .doc-container {
                max-width: 100%;
            }

            a[href^="http"]::after {
                content: " (" attr(href) ")";
                font-size: 90%;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar (selaras landing, tanpa Panduan) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="/">SIGARDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="/#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-success btn-sm" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header/Hero -->
    <header class="hero py-5">
        <div class="container doc-container">
            <h1 class="fw-bold mb-2">Syarat & Ketentuan Penggunaan SIGARDA</h1>
            <p class="text-muted mb-0">Versi: <strong>1.0</strong> · Tanggal Berlaku: <strong>9 September 2025</strong></p>
            <small class="text-muted">Sistem: SIGARDA — <em>Sistem Informasi Gerbang Arsip Digital Pegawai</em></small>
            <div class="mt-3 d-flex gap-2">
                <a href="/" class="btn btn-outline-success btn-sm">← Kembali ke Beranda</a>
                <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">🖨️ Cetak</button>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="py-4">
        <div class="container doc-container">
            <div class="row g-4">
                <!-- TOC -->
                <aside class="col-lg-4">
                    <div class="card sticky-top toc" style="top: 90px;">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Daftar Isi</h5>
                            <ol class="mb-0">
                                <li><a href="#pendahuluan">Pendahuluan & Penerimaan</a></li>
                                <li><a href="#definisi">Definisi</a></li>
                                <li><a href="#ruang-lingkup">Ruang Lingkup Layanan</a></li>
                                <li><a href="#akses-akun">Akses Akun & Keamanan</a></li>
                                <li><a href="#perilaku">Perilaku Pengguna yang Dilarang</a></li>
                                <li><a href="#dokumen-haki">Dokumen, Hak Cipta & Tanggung Jawab</a></li>
                                <li><a href="#integrasi">Integrasi & Layanan Pihak Ketiga</a></li>
                                <li><a href="#privasi">Privasi & Perlindungan Data</a></li>
                                <li><a href="#ketersediaan">Ketersediaan Layanan & Pemeliharaan</a></li>
                                <li><a href="#pembatasan">Pembatasan Tanggung Jawab</a></li>
                                <li><a href="#perubahan">Perubahan Layanan & Ketentuan</a></li>
                                <li><a href="#pengakhiran">Pengakhiran Akses</a></li>
                                <li><a href="#hukum-sengketa">Hukum yang Berlaku & Penyelesaian Sengketa</a></li>
                                <li><a href="#kontak">Kontak</a></li>
                            </ol>
                        </div>
                    </div>
                </aside>

                <!-- Document -->
                <section class="col-lg-8 doc">
                    <div class="card">
                        <div class="card-body">
                            <h2 id="pendahuluan">1) Pendahuluan & Penerimaan</h2>
                            <p>Dengan mengakses dan/atau menggunakan SIGARDA, Anda menyatakan telah membaca, memahami, dan setuju untuk terikat oleh Syarat & Ketentuan ini. Jika Anda tidak setuju, harap hentikan penggunaan SIGARDA.</p>

                            <h2 id="definisi">2) Definisi</h2>
                            <ul>
                                <li><strong>Pengguna</strong>: ASN/PPPK, admin, verifikator, dan pihak lain yang sah menggunakan SIGARDA.</li>
                                <li><strong>Dokumen</strong>: berkas digital yang diunggah atau dikelola melalui SIGARDA.</li>
                                <li><strong>TTE</strong>: Tanda Tangan Elektronik yang sah sesuai ketentuan peraturan perundang-undangan.</li>
                            </ul>

                            <h2 id="ruang-lingkup">3) Ruang Lingkup Layanan</h2>
                            <p>SIGARDA menyediakan fungsi pengelolaan arsip kepegawaian, termasuk unggah, penyimpanan, pencarian, verifikasi, dan pelacakan status dokumen, sesuai kebijakan internal dan ketentuan kearsipan pemerintah.</p>

                            <h2 id="akses-akun">4) Akses Akun & Keamanan</h2>
                            <ul>
                                <li>Pengguna wajib menjaga kerahasiaan kredensial (username, kata sandi, MFA bila tersedia).</li>
                                <li>Setiap aktivitas yang terjadi melalui akun Anda menjadi tanggung jawab Anda.</li>
                                <li>Laporkan dugaan pelanggaran keamanan kepada admin SIGARDA segera.</li>
                            </ul>

                            <h2 id="perilaku">5) Perilaku Pengguna yang Dilarang</h2>
                            <ul>
                                <li>Mengunggah konten yang melanggar hukum, berisi malware, atau melanggar hak pihak ketiga.</li>
                                <li>Mengakses data tanpa kewenangan, mencoba meretas, atau menghindari kontrol keamanan.</li>
                                <li>Mengubah, mendistribusikan, atau mempublikasikan dokumen di luar mandat/tugas dinas.</li>
                            </ul>

                            <h2 id="dokumen-haki">6) Dokumen, Hak Cipta & Tanggung Jawab</h2>
                            <ul>
                                <li>Pengguna memastikan dokumen yang diunggah akurat, sah, dan sesuai peruntukan.</li>
                                <li>Hak kekayaan intelektual atas dokumen mengikuti ketentuan peraturan dan kebijakan internal.</li>
                                <li>Penyalahgunaan dokumen menjadi tanggung jawab pihak yang melanggar.</li>
                            </ul>

                            <h2 id="integrasi">7) Integrasi & Layanan Pihak Ketiga</h2>
                            <p>SIGARDA dapat terintegrasi dengan layanan pihak ketiga (mis. TTE, penyimpanan). Ketentuan pihak ketiga tersebut berlaku sepanjang relevan, tanpa mengurangi ketentuan ini.</p>

                            <h2 id="privasi">8) Privasi & Perlindungan Data</h2>
                            <p>Penggunaan SIGARDA juga tunduk pada <a href="/privacy-policy">Kebijakan Privasi</a>. Kami memproses data sesuai ketentuan perundang-undangan dan prinsip perlindungan data.</p>

                            <h2 id="ketersediaan">9) Ketersediaan Layanan & Pemeliharaan</h2>
                            <ul>
                                <li>Kami berupaya menjaga ketersediaan layanan secara wajar.</li>
                                <li>Pemeliharaan terjadwal atau darurat dapat menyebabkan layanan tidak tersedia sementara.</li>
                                <li>Konten dan fitur dapat berubah menyesuaikan kebutuhan dan kebijakan.</li>
                            </ul>

                            <h2 id="pembatasan">10) Pembatasan Tanggung Jawab</h2>
                            <p>Sepanjang diizinkan hukum yang berlaku, SIGARDA disediakan "sebagaimana adanya". Kami tidak bertanggung jawab atas kerugian tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan atau ketidaktersediaan layanan.</p>

                            <h2 id="perubahan">11) Perubahan Layanan & Ketentuan</h2>
                            <p>Kami dapat memperbarui ketentuan ini dari waktu ke waktu. Tanggal revisi akan dicantumkan di bagian atas. Terus menggunakan layanan setelah perubahan berlaku dianggap sebagai persetujuan.</p>

                            <h2 id="pengakhiran">12) Pengakhiran Akses</h2>
                            <p>Akses dapat dihentikan sementara atau permanen apabila ditemukan pelanggaran kebijakan, ancaman keamanan, atau alasan sah lainnya sesuai ketentuan.</p>

                            <h2 id="hukum-sengketa">13) Hukum yang Berlaku & Penyelesaian Sengketa</h2>
                            <p>Ketentuan ini diatur oleh peraturan perundang-undangan Republik Indonesia. Sengketa akan diselesaikan melalui mekanisme yang berlaku pada instansi terkait atau peradilan yang berwenang.</p>

                            <h2 id="kontak">14) Kontak</h2>
                            <p>Pertanyaan terkait ketentuan ini:<br>
                                <strong>Admin/PPID SIGARDA</strong><br>
                                Email: pessel@kemenag.go.id · Telepon: +62896-7754-2744
                            </p>

                            <hr>
                            <p class="text-muted">
                                Terakhir diperbarui: 9 September 2025 ·
                                <a href="/">Kembali ke Landing Page SIGARDA</a>
                            </p>
                            <p class="text-muted mb-0">
                                Tautan cepat:
                                <a href="/#about">Tentang</a> ·
                                <a href="/#features">Fitur</a> ·
                                <a href="/privacy-policy">Kebijakan Privasi</a> ·
                                <a href="/#contact">Kontak</a>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer (selaras landing) -->
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
    <script>
        // Highlight aktif TOC saat scroll
        document.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.doc h2[id]');
            const tocLinks = document.querySelectorAll('.toc a');
            let current = null;
            sections.forEach(sec => {
                const rect = sec.getBoundingClientRect();
                if (rect.top <= 120) current = sec.id;
            });
            tocLinks.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + current));
        });
    </script>
</body>

</html>
