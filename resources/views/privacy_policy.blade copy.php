<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kebijakan Privasi — SIGARDA</title>
    <meta name="description" content="Kebijakan Privasi SIGARDA (Sistem Informasi Gerbang Arsip Digital Pegawai) Kementerian Agama Kabupaten Pesisir Selatan." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* === Tema seragam dengan landing === */
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

    <!-- Header/Hero (gradien seperti landing) -->
    <header class="hero py-5">
        <div class="container doc-container">
            <h1 class="fw-bold mb-2">Kebijakan Privasi SIGARDA</h1>
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
                                <li><a href="#ringkasan-eksekutif">Ringkasan Eksekutif</a></li>
                                <li><a href="#ruang-lingkup">Ruang Lingkup</a></li>
                                <li><a href="#definisi-singkat">Definisi Singkat</a></li>
                                <li><a href="#dasar-hukum-dan-prinsip">Dasar Hukum dan Prinsip</a></li>
                                <li><a href="#jenis-data">Jenis Data yang Diproses</a></li>
                                <li><a href="#cara-pengumpulan">Cara Pengumpulan Data</a></li>
                                <li><a href="#tujuan-pemrosesan">Tujuan Pemrosesan</a></li>
                                <li><a href="#legal-basis">Dasar Pemrosesan per Tujuan</a></li>
                                <li><a href="#berbagi-data">Berbagi Data & Penerima</a></li>
                                <li><a href="#lokasi-transfer">Lokasi Penyimpanan & Transfer Internasional</a></li>
                                <li><a href="#retensi-arsip">Retensi & Arsip</a></li>
                                <li><a href="#keamanan">Keamanan Informasi</a></li>
                                <li><a href="#hak-subjek">Hak Subjek Data</a></li>
                                <li><a href="#kuki">Kuki & Teknologi Serupa</a></li>
                                <li><a href="#otomatis-profiling">Keputusan Otomatis & Profiling</a></li>
                                <li><a href="#anak">Anak di Bawah Umur</a></li>
                                <li><a href="#perubahan">Perubahan Kebijakan</a></li>
                                <li><a href="#kontak">Kontak & Pengaduan</a></li>
                                <li><a href="#ketentuan-pemerintahan">Ketentuan Khusus Pemerintahan</a></li>
                                <li><a href="#lampiran">Lampiran</a></li>
                            </ol>
                        </div>
                    </div>
                </aside>

                <!-- Document -->
                <section class="col-lg-8 doc">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Pengendali Data (Data Controller):</strong> [Kantor Kementerian Agama Kabupaten Pesisir Selatan] ("Kami")<br>
                                <strong>Kontak PPID/DPO:</strong><br>
                                [Yossef Yuda, S.HI, MA]
                                [198008042005011007@kemenag.go.id], [+62 812-6158-2843] <br>
                                [MH2H+9PW, Jl. Imam Bonjol, Painan, Kec. Iv Jurai, Kabupaten Pesisir Selatan, Sumatera Barat 25651]
                            </p>

                            <hr>
                            <h2 id="ringkasan-eksekutif">1) Ringkasan Eksekutif</h2>
                            <p>SIGARDA digunakan untuk pengelolaan arsip kepegawaian ASN/PPPK, termasuk penyimpanan, verifikasi, dan pelayanan administrasi berbasis elektronik. Kami memproses data pribadi sesuai <strong>UU No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP)</strong>, <strong>Perpres 95/2018 tentang SPBE</strong>, <strong>PP 71/2019 tentang PSTE</strong>, serta ketentuan kearsipan yang berlaku (<strong>UU 43/2009</strong> dan regulasi ANRI/JRA). Dokumen ini menjelaskan jenis data, tujuan, dasar pemrosesan, retensi, penerima data, hak subjek data, dan keamanan informasi.</p>

                            <h2 id="ruang-lingkup">2) Ruang Lingkup</h2>
                            <p>Kebijakan ini berlaku untuk seluruh pengguna SIGARDA: ASN/PPPK, pejabat pengelola, admin, verifikator, dan pihak internal/eksternal yang sah memperoleh akses sesuai mandat peraturan.</p>

                            <h2 id="definisi-singkat">3) Definisi Singkat</h2>
                            <ul>
                                <li><strong>Data Pribadi:</strong> setiap data tentang orang perseorangan yang teridentifikasi/teridentifikasi secara tersendiri.</li>
                                <li><strong>Pemrosesan Data:</strong> setiap kegiatan terhadap data pribadi (mengumpulkan, merekam, menyimpan, mengubah, menampilkan, menyebarluaskan, menghapus, dsb.).</li>
                                <li><strong>Pengendali Data:</strong> pihak yang menentukan tujuan dan melakukan kendali pemrosesan.</li>
                                <li><strong>Prosesor/Sub-Pemroses:</strong> pihak yang memproses atas nama Pengendali Data.</li>
                                <li><strong>JRA:</strong> Jadwal Retensi Arsip.</li>
                            </ul>

                            <h2 id="dasar-hukum-dan-prinsip">4) Dasar Hukum dan Prinsip</h2>
                            <p>Kami memproses data berdasarkan:</p>
                            <ul>
                                <li><strong>Kewajiban hukum & tugas penyelenggaraan pemerintahan</strong> (public task/official authority).</li>
                                <li><strong>Pelaksanaan perjanjian/kontrak</strong> layanan kepegawaian internal.</li>
                                <li><strong>Persetujuan</strong> untuk fitur opsional (mis. notifikasi email/WhatsApp, integrasi tertentu).</li>
                                <li><strong>Kepentingan yang sah</strong> untuk peningkatan mutu layanan & keamanan, dengan mempertimbangkan hak-hak subjek data.</li>
                            </ul>
                            <p>Prinsip pemrosesan: <strong>legalitas</strong>, <strong>tujuan yang spesifik</strong>, <strong>minimisasi data</strong>, <strong>akurasi</strong>, <strong>pembatasan retensi</strong>, <strong>integritas & kerahasiaan</strong>, <strong>akuntabilitas</strong>.</p>

                            <h2 id="jenis-data">5) Jenis Data yang Diproses</h2>
                            <p><strong>Identitas & Kepegawaian:</strong> NIP/NIK, nama, tanggal lahir, agama, alamat, alamat email, no. telepon, unit kerja, jabatan, golongan/pangkat, status kepegawaian, riwayat SK (CPNS/PNS, pangkat, KGB, mutasi), riwayat pendidikan & sertifikasi, NPWP, BPJS, data keluarga (sebatas yang disyaratkan layanan).<br>
                                <strong>Dokumen Arsip:</strong> SK, ijazah & transkrip, sertifikat pelatihan, surat keputusan, penilaian kinerja, kontrak, dokumen pendukung lain sesuai JRA.<br>
                                <strong>TTE & Integrasi:</strong> identitas sertifikat TTE (BSrE), log penandatanganan, hash dokumen.<br>
                                <strong>Data Teknis:</strong> log aktivitas (waktu, IP, user agent), kontrol akses (role/permission), <em>audit trail</em>, bukti unggah/unduh, berkas sementara, metadata file.<br>
                                <strong>Kuki & Telemetri</strong> (jika diaktifkan): preferensi tampilan, sesi login (session cookie), <em>error trace</em> untuk peningkatan layanan.
                            </p>
                            <div class="alert alert-info"><strong>Catatan:</strong> Kami tidak meminta data sensitif di luar mandat (mis. biometrik, kesehatan) kecuali diwajibkan peraturan layanan tertentu. Jika diwajibkan, akan diinformasikan secara khusus.</div>

                            <h2 id="cara-pengumpulan">6) Cara Pengumpulan Data</h2>
                            <ul>
                                <li>Input langsung oleh pegawai/operator melalui formulir SIGARDA.</li>
                                <li>Sinkronisasi dari sistem internal (mis. SIMPEG/HRIS) sesuai perjanjian & mandat.</li>
                                <li>Unggah berkas oleh pengguna/petugas berwenang.</li>
                                <li>Integrasi layanan pemerintah (mis. <strong>BSrE</strong> untuk TTE) sesuai ketentuan.</li>
                            </ul>

                            <h2 id="tujuan-pemrosesan">7) Tujuan Pemrosesan</h2>
                            <ul>
                                <li>Pengelolaan arsip kepegawaian, administrasi layanan, dan penerbitan dokumen.</li>
                                <li>Verifikasi keabsahan dokumen dan <em>compliance</em> pemerintahan (SPBE, kearsipan, audit).</li>
                                <li>Pelaporan & statistik internal (non-identifiable apabila memungkinkan).</li>
                                <li>Keamanan sistem: pencegahan penipuan, <em>rate limiting</em>, audit keamanan, penegakan kebijakan akses.</li>
                                <li>Peningkatan mutu layanan, <em>debugging</em>, dan pemeliharaan.</li>
                            </ul>

                            <h2 id="legal-basis">8) Dasar Pemrosesan (Legal Basis) Per Tujuan</h2>
                            <ul>
                                <li>Administrasi & arsip kepegawaian → <strong>Kewajiban hukum/mandat publik</strong>.</li>
                                <li>Verifikasi, audit, pelaporan → <strong>Kewajiban hukum/mandat publik</strong>.</li>
                                <li>Notifikasi opsional (email/WhatsApp) → <strong>Persetujuan</strong>.</li>
                                <li>Analitik teknis & peningkatan mutu → <strong>Kepentingan yang sah</strong> (dengan <em>safeguard</em>).</li>
                            </ul>

                            <h2 id="berbagi-data">9) Berbagi Data & Penerima</h2>
                            <p>Data dapat dibagikan secara terbatas kepada:</p>
                            <ul>
                                <li>Unit kerja internal berwenang (Subbag TU, Kepegawaian).</li>
                                <li>Instansi pemerintah terkait ( <strong>BKN</strong>, <strong>Kanwil Kemenag</strong>, <strong>ANRI</strong> dalam konteks kearsipan, <strong>BSSN/BSrE</strong> untuk TTE).</li>
                                <li><strong>Prosesor/Sub-Pemroses</strong> yang mendukung layanan TI (pusat data, pengiriman email/SMS gateway, layanan <em>logging</em>), berdasarkan perjanjian pemrosesan data & <em>confidentiality</em>.</li>
                            </ul>
                            <div class="alert alert-secondary">Kami <strong>tidak</strong> menjual data pribadi. Setiap permintaan dari penegak hukum dipenuhi sesuai prosedur dan peraturan perundang-undangan.</div>

                            <h2 id="lokasi-transfer">10) Lokasi Penyimpanan & Transfer Internasional</h2>
                            <p>Data disimpan pada infrastruktur pusat data yang ditunjuk [Jakarta, <strong>Indonesia</strong> / <strong>DC internal pemerintah</strong>]. Transfer lintas negara <strong>tidak</strong> dilakukan kecuali diwajibkan/dimungkinkan oleh peraturan dengan <em>safeguard</em> yang memadai dan pemberitahuan.</p>

                            <h2 id="retensi-arsip">11) Retensi & Arsip</h2>
                            <ul>
                                <li>Masa simpan mengikuti <strong>JRA Kementerian Agama/ANRI</strong> dan ketentuan peraturan kearsipan.</li>
                                <li>Log akses & <em>audit trail</em> disimpan sesuai standar SPBE/keamanan informasi [mis. ≥ 2 tahun] atau sebagaimana diatur kebijakan internal.</li>
                                <li>Setelah masa retensi berakhir, data akan dihapus/dianonimkan atau dialihmedia menjadi arsip statis sesuai ketentuan ANRI.</li>
                            </ul>

                            <h2 id="keamanan">12) Keamanan Informasi</h2>
                            <ul>
                                <li><strong>Enkripsi</strong> <em>in transit</em> (TLS 1.2+) dan <em>at rest</em> untuk berkas sensitif.</li>
                                <li><strong>Kontrol akses berbasis peran (RBAC)</strong>, autentikasi kuat, dan <strong>MFA</strong> untuk akun admin.</li>
                                <li><strong>Pemantauan & audit log</strong>; <em>alerting</em> anomali; peninjauan akses berkala.</li>
                                <li><strong>Isolasi lingkungan</strong>, <em>hardening</em> server, <em>backup</em> terenkripsi & uji pemulihan.</li>
                                <li><strong>Uji kerentanan/penetrasi</strong> berkala dan <em>patch management</em>.</li>
                                <li><strong>DPA/SLA</strong> dengan sub-pemroses, termasuk kerahasiaan dan kewajiban keamanan.</li>
                            </ul>
                            <div class="alert alert-warning">Meski telah menerapkan praktik terbaik, tidak ada sistem yang 100% aman. Kami melakukan respons insiden sesuai SOP dan kewajiban notifikasi insiden data.</div>

                            <h2 id="hak-subjek">13) Hak Subjek Data</h2>
                            <p>Sesuai UU PDP, Anda memiliki hak untuk:</p>
                            <ul>
                                <li>Mendapatkan informasi mengenai pemrosesan data pribadi Anda.</li>
                                <li>Mengakses dan memperoleh salinan data pribadi.</li>
                                <li>Memperbaiki atau melengkapi data yang tidak akurat/tidak lengkap.</li>
                                <li>Menghapus data pribadi <strong>sepanjang tidak bertentangan</strong> dengan kewajiban arsip/ketentuan hukum.</li>
                                <li>Menunda/menolak pemrosesan dalam kondisi tertentu sesuai hukum.</li>
                                <li>Menarik persetujuan untuk fitur opsional, tanpa memengaruhi pemrosesan yang sah sebelumnya.</li>
                                <li>Mengajukan keberatan/keluhan.</li>
                            </ul>
                            <p><strong>Cara mengajukan permohonan:</strong><br>Kirim permintaan ke <strong>PPID/DPO</strong> melalui [email/portal khusus]. Kami akan menindaklanjuti sesuai tenggat peraturan. Verifikasi identitas mungkin diperlukan.</p>

                            <h2 id="kuki">14) Kuki & Teknologi Serupa</h2>
                            <p>SIGARDA menggunakan <strong>session cookie</strong> untuk autentikasi dan preferensi. Kami tidak menggunakan pelacak pihak ketiga untuk periklanan. Anda dapat mengelola kuki melalui pengaturan peramban; namun, menonaktifkan session cookie dapat menghambat fungsi login.</p>

                            <h2 id="otomatis-profiling">15) Keputusan Otomatis & <em>Profiling</em></h2>
                            <p>SIGARDA <strong>tidak</strong> melakukan keputusan otomatis yang berdampak hukum setara terhadap individu tanpa campur tangan manusia. Pengelompokan/validasi otomatis (mis. pemeriksaan format berkas) hanya untuk efisiensi layanan.</p>

                            <h2 id="anak">16) Anak di Bawah Umur</h2>
                            <p>SIGARDA ditujukan untuk pengelolaan pegawai (dewasa). Tidak ditujukan bagi anak di bawah umur.</p>

                            <h2 id="perubahan">17) Perubahan Kebijakan</h2>
                            <p>Kebijakan ini dapat diperbarui sewaktu-waktu. Tanggal revisi terbaru akan dicantumkan di bagian atas. Perubahan material akan diinformasikan melalui kanal resmi internal.</p>

                            <h2 id="kontak">18) Kontak & Pengaduan</h2>
                            <p>Pertanyaan, permintaan hak, atau pengaduan terkait privasi:<br>
                                <strong>PPID/DPO SIGARDA</strong><br>
                                Email: [pessel@kemenag.go.id]<br>
                                Alamat: [MH2H+9PW, Jl. Imam Bonjol, Painan, Kec. Iv Jurai, Kabupaten Pesisir Selatan, Sumatera Barat 25651]<br>
                                Telepon: [(0756) 21305]
                            </p>
                            <p>Jika respons kami tidak memuaskan, Anda dapat menyampaikan pengaduan ke <strong>otoritas pengawas perlindungan data yang berwenang</strong> sesuai peraturan perundang-undangan.</p>

                            <h2 id="ketentuan-pemerintahan">19) Ketentuan Khusus Pemerintahan</h2>
                            <ul>
                                <li>Akses data dibatasi pada pejabat berwenang berdasarkan surat tugas/mandat.</li>
                                <li>Pelayanan informasi publik melalui mekanisme <strong>PPID</strong> sesuai UU KIP, dengan tetap melindungi data pribadi.</li>
                                <li><em>Recordkeeping</em> mengikuti standar kearsipan pemerintah dan SPBE.</li>
                                <li>Integrasi TTE mematuhi ketentuan <strong>BSrE/BSSN</strong>.</li>
                            </ul>

                            <h2 id="lampiran">20) Lampiran</h2>
                            {{-- <p><strong>Lampiran A – Daftar Prosesor/Sub-Pemroses</strong></p>
                            <ul>
                                <li>[Nama Penyedia Pusat Data] – Lokasi: [Indonesia], Peran: <em>hosting & storage</em>.</li>
                                <li>[Email/SMS Gateway] – Peran: <em>pengiriman notifikasi</em>.</li>
                                <li>[Sistem Log/Observability] – Peran: <em>pemantauan</em>.</li>
                            </ul> --}}
                            <p><strong>Lampiran – Dasar Hukum & Referensi</strong></p>
                            <ul>
                                <li>UU 27/2022 Perlindungan Data Pribadi</li>
                                <li>Perpres 95/2018 Sistem Pemerintahan Berbasis Elektronik</li>
                                <li>PP 71/2019 Penyelenggaraan Sistem dan Transaksi Elektronik</li>
                                <li>UU 43/2009 Kearsipan & ketentuan ANRI (JRA)</li>
                                <li>[Kebijakan internal SPBE/Keamanan Informasi Kemenag]</li>
                            </ul>

                            <hr>
                            <p class="text-muted">
                                Terakhir diperbarui: 9 September 2025 ·
                                <a href="/">Kembali ke Landing Page SIGARDA</a>
                            </p>
                            <!-- Quick links—tanpa Panduan -->
                            <p class="text-muted mb-0">
                                Tautan cepat:
                                <a href="/#about">Tentang</a> ·
                                <a href="/#features">Fitur</a> ·
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
