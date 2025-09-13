@extends('layouts.app')

@section('title', 'SIGARDA — Personnel Digital Archiving System (ASN)')
@section('meta_description', 'SIGARDA is a Personnel Digital Archiving System for secure, structured, and compliant management of personnel archives.')
@section('og_title', 'SIGARDA — Personnel Digital Archiving System (ASN)')
@section('og_description', 'Secure, structured, and regulation-compliant management of personnel archives.')

@section('header')
    @include('partials.header-hero')
@endsection

@section('content')
    {{-- ABOUT (EN + ID containers) --}}
    <section id="about" class="py-5">
        <div class="container" id="about-en">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">About SIGARDA</h2>
                            <p class="text-muted">
                                SIGARDA supports digitization of personnel archives: upload, classification, tiered verification,
                                and retention management per regulations.
                            </p>
                            <ul class="list-check">
                                <li>Official government application.</li>
                                <li>Upload, store, search, verify, download.</li>
                                <li>RBAC, HTTPS, audit trail.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Key Benefits</h3>
                            <ul class="list-check">
                                <li>Reduce paper archives, speed up HR services.</li>
                                <li><span class="kbd">Google Drive</span> integration (optional) for redundancy.</li>
                                <li>Complete verification trail for audit & compliance.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ABOUT ID --}}
        <div class="container d-none" id="tentang">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">Tentang SIGARDA</h2>
                            <p class="text-muted">
                                SIGARDA mendukung digitalisasi arsip pegawai: unggah, klasifikasi, verifikasi berjenjang,
                                hingga retensi arsip sesuai ketentuan.
                            </p>
                            <ul class="list-check">
                                <li>Aplikasi resmi instansi pemerintah.</li>
                                <li>Unggah, simpan, telusur, verifikasi, unduh.</li>
                                <li>RBAC, HTTPS, audit trail.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Manfaat Utama</h3>
                            <ul class="list-check">
                                <li>Kurangi arsip kertas, percepat layanan kepegawaian.</li>
                                <li>Integrasi <span class="kbd">Google Drive</span> (opsional) untuk redundansi.</li>
                                <li>Jejak verifikasi lengkap untuk audit & kepatuhan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES (EN + ID) --}}
    <section id="features" class="py-5 bg-light">
        <div class="container" id="features-en">
            <h2 class="h3 mb-4">Application Features</h2>
            <div class="row g-4">
                @foreach ([['Upload & Classification', 'Upload PDFs/images, categorize to archival standards, add metadata.'], ['Tiered Verification', 'Verification flow by authorized staff with notes & status.'], ['Fast Search', 'Search by name, NIP, type, or date.'], ['Drive Integration (Optional)', 'Store a copy to institution’s Google Drive for reliability.'], ['Security & Audit', 'RBAC, in-transit encryption (HTTPS), activity logs.'], ['Export & Retention', 'Manage retention & export per internal policies.']] as [$title, $desc])
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5">{{ $title }}</h3>
                                <p class="text-muted mb-0">{{ $desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container d-none" id="fitur">
            <h2 class="h3 mb-4">Fitur Aplikasi</h2>
            <div class="row g-4">
                @foreach ([['Unggah & Klasifikasi', 'Unggah PDF/gambar, kategorikan sesuai standar arsip, beri metadata.'], ['Verifikasi Berjenjang', 'Alur verifikasi oleh petugas berwenang dengan catatan & status.'], ['Pencarian Cepat', 'Cari dokumen berdasarkan nama, NIP, jenis, atau tanggal.'], ['Integrasi Drive (Opsional)', 'Simpan salinan ke Google Drive instansi.'], ['Keamanan & Audit', 'RBAC, enkripsi in-transit (HTTPS), log aktivitas.'], ['Ekspor & Retensi', 'Kelola retensi & ekspor sesuai kebijakan internal.']] as [$title, $desc])
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5">{{ $title }}</h3>
                                <p class="text-muted mb-0">{{ $desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DATA TRANSPARENCY (EN + ID) --}}
    <section id="data" class="py-5">
        <div class="container" id="data-en">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">Data Transparency & Permissions (OAuth Scopes)</h2>
                            <p class="text-muted">
                                SIGARDA requests only the minimum access for core functions. If Google Drive integration is enabled by admins, these scopes may be requested:
                            </p>
                            <ul class="list-check">
                                <li><span class="kbd">openid, email, profile</span> — identity & basic personalization.</li>
                                <li><span class="kbd">https://www.googleapis.com/auth/drive.file</span> — create/manage <em>only</em> files created by SIGARDA.</li>
                                <li><span class="kbd">https://www.googleapis.com/auth/drive.metadata.readonly</span> — read relevant file metadata for sync.</li>
                            </ul>
                            <p class="small text-muted mb-0">Reason: keep a copy in institution’s Drive for availability & disaster recovery.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Use, Storage, Sharing & Deletion</h3>
                            <ul class="list-check">
                                <li><strong>Use:</strong> authentication & personnel archive management.</li>
                                <li><strong>Storage:</strong> institution servers; copy to Drive (optional).</li>
                                <li><strong>Sharing:</strong> not shared beyond operational/legal needs.</li>
                                <li><strong>Deletion:</strong> per retention policy; data subject requests accepted.</li>
                                <li><strong>Control:</strong> revoke at <span class="kbd">myaccount.google.com/permissions</span>.</li>
                            </ul>
                            <p class="small text-muted mb-0">Full details in the <a href="/privacy-policy">Privacy Policy</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-none" id="data-id">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">Transparansi Data & Izin (OAuth Scopes)</h2>
                            <p class="text-muted">
                                SIGARDA hanya meminta akses minimum. Jika integrasi Google Drive diaktifkan admin, izin berikut mungkin diminta:
                            </p>
                            <ul class="list-check">
                                <li><span class="kbd">openid, email, profile</span> — identitas & personalisasi.</li>
                                <li><span class="kbd">https://www.googleapis.com/auth/drive.file</span> — membuat/mengelola <em>hanya</em> file yang dibuat SIGARDA.</li>
                                <li><span class="kbd">https://www.googleapis.com/auth/drive.metadata.readonly</span> — membaca metadata relevan untuk sinkronisasi.</li>
                            </ul>
                            <p class="small text-muted mb-0">Alasan: salinan di Drive instansi untuk ketersediaan & pemulihan bencana.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Penggunaan, Penyimpanan, Berbagi & Penghapusan</h3>
                            <ul class="list-check">
                                <li><strong>Penggunaan:</strong> otentikasi & pengelolaan arsip kepegawaian.</li>
                                <li><strong>Penyimpanan:</strong> server instansi; salinan ke Drive (opsional).</li>
                                <li><strong>Berbagi:</strong> tidak di luar kebutuhan operasional/hukum.</li>
                                <li><strong>Penghapusan:</strong> sesuai retensi; permintaan subjek data diterima.</li>
                                <li><strong>Kontrol:</strong> cabut di <span class="kbd">myaccount.google.com/permissions</span>.</li>
                            </ul>
                            <p class="small text-muted mb-0">Detail lengkap ada di <a href="/privacy-policy">Kebijakan Privasi</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PRIVACY (EN + ID) --}}
    <section id="privacy" class="py-5 bg-light">
        <div class="container" id="privacy-en">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Privacy Policy</h2>
                    <p class="text-muted">Read how your data is collected, used, stored, shared, and your choices/controls.</p>
                    <a class="btn btn-outline-success" href="/privacy-policy">Open Privacy Policy</a>
                    <p class="small text-muted mt-3 mb-0"><strong>Important:</strong> URL must match the Google OAuth Consent Screen.</p>
                </div>
            </div>
        </div>

        <div class="container d-none" id="privasi">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Kebijakan Privasi</h2>
                    <p class="text-muted">Baca cara data dikumpulkan, digunakan, disimpan, dibagikan, serta pilihan/kontrol Anda.</p>
                    <a class="btn btn-outline-success" href="/privacy-policy">Buka Kebijakan Privasi</a>
                    <p class="small text-muted mt-3 mb-0"><strong>Penting:</strong> URL harus sama dengan di Google OAuth Consent Screen.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ (EN + ID) --}}
    <section class="py-5">
        <div class="container" id="faq-en">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">Frequently Asked Questions</h2>
                            <h3 class="h6 mt-3">Is this page accessible without login?</h3>
                            <p class="text-muted">Yes. SIGARDA info & Privacy Policy are public.</p>
                            <h3 class="h6">Who manages SIGARDA?</h3>
                            <p class="text-muted">Office of the Ministry of Religious Affairs — Pesisir Selatan.</p>
                            <h3 class="h6">Is all data stored in Google Drive?</h3>
                            <p class="text-muted">No. Drive is used only if enabled. Core archives remain on institution servers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Eligibility Checklist (Google Verification)</h3>
                            <ul class="list-check">
                                <li>Clear & consistent app identity and branding.</li>
                                <li>Complete, understandable description of app functions.</li>
                                <li>Transparent scopes and purposes for data access.</li>
                                <li>Privacy Policy hosted on a verified institution domain.</li>
                                <li>Publicly viewable page without login.</li>
                            </ul>
                            {{-- <div class="alert alert-warning mt-3 mb-0"><strong>Hosting Note:</strong> Use an institution-owned domain, not third-party platforms.</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-none" id="faq-id">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4">Pertanyaan Umum</h2>
                            <h3 class="h6 mt-3">Apakah halaman ini bisa diakses tanpa login?</h3>
                            <p class="text-muted">Ya. Informasi SIGARDA & Kebijakan Privasi tersedia untuk publik.</p>
                            <h3 class="h6">Siapa pengelola SIGARDA?</h3>
                            <p class="text-muted">Kantor Kementerian Agama Kabupaten Pesisir Selatan.</p>
                            <h3 class="h6">Apakah semua data disimpan di Google Drive?</h3>
                            <p class="text-muted">Tidak. Drive hanya digunakan bila diaktifkan. Arsip inti berada di server instansi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h5">Checklist Kelayakan (Verifikasi Google)</h3>
                            <ul class="list-check">
                                <li>Identitas & brand jelas dan konsisten.</li>
                                <li>Deskripsi fungsi lengkap & mudah dipahami.</li>
                                <li>Transparansi izin (scopes) & tujuan akses data.</li>
                                <li>Kebijakan Privasi pada domain instansi terverifikasi.</li>
                                <li>Halaman publik dapat dilihat tanpa login.</li>
                            </ul>
                            <div class="alert alert-warning mt-3 mb-0"><strong>Catatan Hosting:</strong> Gunakan domain milik instansi, bukan platform pihak ketiga.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACT (EN + ID) --}}
    <section id="contact" class="py-5 bg-light">
        <div class="container" id="contact-en">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Official Contact</h2>
                    <p class="text-muted small">For app questions, data policy, or data-subject requests (access, correction, deletion):</p>
                    <ul class="mb-0">
                        <li><strong>Institution:</strong> Office of the Ministry of Religious Affairs — Pesisir Selatan</li>
                        <li><strong>Address:</strong> <em>Jl. Imam Bonjol No.1, IV Jurai, Painan, Pesisir Selatan, West Sumatra, Indonesia</em></li>
                        <li><strong>Email:</strong> <a href="mailto:pessel@kemenag.go.id">pessel@kemenag.go.id</a></li>
                        <li><strong>Phone:</strong> <a href="tel:+6289677542744">+62-896-7754-2744</a></li>
                        <li><strong>Service Hours:</strong> Monday–Friday, 08:00–16:00 WIB</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container d-none" id="kontak">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Kontak Resmi</h2>
                    <p class="text-muted small">Untuk pertanyaan aplikasi, kebijakan data, atau permintaan hak subjek data (akses, koreksi, penghapusan):</p>
                    <ul class="mb-0">
                        <li><strong>Instansi:</strong> Kantor Kementerian Agama Kabupaten Pesisir Selatan</li>
                        <li><strong>Alamat:</strong> <em>Jl. Imam Bonjol No.1, IV Jurai, Painan, Pesisir Selatan, Sumatera Barat, Indonesia</em></li>
                        <li><strong>Email:</strong> <a href="mailto:pessel@kemenag.go.id">pessel@kemenag.go.id</a></li>
                        <li><strong>Telepon:</strong> <a href="tel:+6289677542744">+62-896-7754-2744</a></li>
                        <li><strong>Jam Layanan:</strong> Senin–Jumat, 08.00–16.00 WIB</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
