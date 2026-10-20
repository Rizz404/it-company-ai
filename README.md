# IT Company AI

Pengalaman perusahaan IT multi-tenant dengan panggung ilustrasi, tab atas, panel layanan lebar, konsultan AI, narator, dan chat tengah. Bahasa publik: Indonesia, Inggris, Jepang. Laravel 13, Blade, Alpine 3, Tailwind 4, Vite 8. SQLite lokal; PostgreSQL untuk produksi.

## Development lokal

Gunakan PHP yang memenuhi lockfile (8.4 atau lebih baru), Composer, dan Node >=22.12. Jalankan `composer setup`, lalu `php artisan db:seed`. Setup menginstal dependency, membuat `.env` dan APP_KEY, menjalankan migrasi, dan membangun aset; tidak menjalankan testing. Untuk server lokal, jalankan `php artisan serve --host=127.0.0.1 --port=8027`.

Database demo berisi tenant `it-company-ai`, enam layanan, empat konsultan, sembilan knowledge items, dan slot hari kerja hingga 60 hari ke depan. Konten, estimasi, profil, dan kebijakan bertanda demo. Tidak ada alamat/nomor telepon nyata. Email `.test` hanya contoh. Seeder lokal tidak membuat akun admin berpassword bawaan.

Halaman pembuka `/`, panggung `/it-company-ai`, dan panel admin `/admin`. Jalur publik per tenant: `services`, `consultants`, `facilities`, `info`, `staff`, `consultation`. Detail layanan dan konsultan tersedia dari katalog. Seluruh navigasi, chat, dan wizard memakai kontrak Blade/JS yang selaras.

Pada lingkungan Windows sesi ini, shim runtime tidak dapat dipakai. Konfigurasi sementara khusus proyek berada di `.local/` yang diabaikan Git. Di PowerShell dari folder proyek, `. .\.local\runtime.ps1` mengaktifkan path binary dan PHP ini untuk shell tersebut. Tidak ada konfigurasi runtime global yang diubah.

## Aturan konsultasi

- Durasi 60 menit; 1–6 peserta; satu konsultasi per konsultan per slot.
- Slot demo Senin–Jumat 09.00–17.00 Asia/Jakarta, jeda 12.00–13.00. Hari libur khusus perlu dikonfirmasi tim.
- Wizard dan AI membuat permintaan `pending`; admin mengonfirmasi atau membatalkan. Situs tidak menerima pembayaran.
- Penahanan kapasitas memakai transaksi dan pembaruan bersyarat. Pembatalan melepaskan kapasitas satu kali; permintaan batal tidak dapat dikonfirmasi ulang.
- Layanan yang diminati boleh dipilih atau dikosongkan untuk discovery. Pengajuan menyimpan snapshot nama layanan, estimasi, mata uang, nama konsultan, durasi, dan biaya konsultasi. Estimasi bukan penawaran final.
- `company:open-slots` menambah horizon bergulir tanpa mereset sesi yang telah ditahan. Jadwal harian pukul 01.00 Asia/Jakarta ada di `routes/console.php`.

## AI dan kontak

Isi `LOCAL_LLM_BASE_URL`, `LOCAL_LLM_API_KEY`, dan `LOCAL_LLM_MODEL` secara privat di `.env`. Base URL tidak memakai akhiran `/v1`; model harus mendukung function calling. Tanpa konfigurasi provider, konten dan wizard tetap tersedia tetapi chat tidak dapat menjawab. Integrasi LLM nyata belum dicoba.

Tujuh tool yang diizinkan: `search_knowledge`, `search_services`, `get_service_offering`, `search_consultants`, `check_consultation_availability`, `create_consultation_request`, `request_human_handover`. Tenant dan percakapan berasal dari server, bukan argumen model. AI hanya membuat permintaan, tidak mengonfirmasi transaksi atau menjanjikan hasil proyek.

`OPENROUTER_*` bersifat opsional untuk TTS narator/chat. Kredensial LLM dan TTS produksi sudah dikonfigurasi secara privat; panggilan provider nyata belum dicoba. `MAIL_MAILER=log` berarti aplikasi belum mengirim email melalui SMTP.

## Produksi

Situs berada di https://it-company-ai.fts-tech.co.id, panggung tenant di https://it-company-ai.fts-tech.co.id/it-company-ai, dan panel admin di https://it-company-ai.fts-tech.co.id/admin. Repository publik https://github.com/Rizz404/it-company-ai memakai branch `main`.

Deployment memakai Plesk Laravel Toolkit dengan mode Automatic dan webhook GitHub untuk event push. Ping webhook diterima HTTP 204. HTTPS Let's Encrypt aktif; endpoint `/up` dan aset CSS/JS mengembalikan HTTP 200. PostgreSQL sudah menjalankan seluruh sembilan migrasi. Data awal produksi berisi enam layanan, empat konsultan, dan sembilan knowledge items yang tetap berlabel demo.

Mailbox dan kontak publik memakai `it-company-ai@fts-tech.co.id`. Akun admin bernama `Admin IT Company AI` memakai email tersebut. Password acak admin dan mailbox disimpan privat di server, tidak di repository. SMTP aplikasi ditunda. Scheduler Toolkit aktif untuk menjalankan jadwal aplikasi, termasuk pembukaan slot harian.

Plesk memberikan peringatan nonfatal saat menautkan log vhost baru. Deployment dan pemeriksaan HTTPS selesai; izin log milik subscription bersama tidak diubah.

`deploy/env.production.example` memakai PostgreSQL. Gunakan PHP 8.4 dan Node 24 pada Plesk sesuai panduan utama. Terapkan `memory_limit=256M`, `max_execution_time=95`, dan `ProxyTimeout 100` hanya pada target. Template nginx/supervisor adalah contoh VPS terpisah dan tidak dipakai di Plesk.

`TRUSTED_PROXIES` dibaca konfigurasi dan diterapkan setelah bootstrap. Isi hanya IP/CIDR proxy yang telah diverifikasi; nilai kosong tidak mempercayai semua proxy.

Untuk tenant kosong, jalankan `php artisan db:seed --class=ProductionCompanySeeder --force`. Seeder ini idempoten dan menghasilkan tenant draft tanpa akun atau data demo. Lengkapi konten/kontak lalu ubah status publik melalui proses administrasi yang disetujui sebelum go-live.

Buat admin tambahan dengan `php artisan company:create-admin --email=<email> --name=<nama> --company=it-company-ai`. Password minimal 12 karakter dibaca dua kali secara rahasia atau dari stdin; jangan berikan sebagai argumen. Command menolak email yang sudah terdaftar. Akun produksi awal sudah dibuat melalui command ini.

Untuk demo produksi, gunakan seeder per kelas dalam urutan Company, ServiceOffering, Consultant, ConsultantImage, ConsultationSlot, CompanyKnowledgeItem; jangan jalankan UserSeeder/CompanyUserSeeder. Seeder demo adalah contoh dan tidak boleh dianggap kebijakan bisnis nyata.

Additional actions Toolkit setelah dependency: `npm run build`, `php artisan migrate --force --no-interaction`, `php artisan optimize`. Jangan memasukkan seeder, pembuatan admin, APP_KEY baru, atau testing ke pipeline deploy. Scheduler Toolkit perlu diaktifkan saat deploy; jadwal di kode saja tidak menjalankan cron server.

## Status pemeriksaan dan izin

CI pemeriksaan hanya dipicu manual melalui `workflow_dispatch`; setiap jenis tes/lint/audit mempunyai pilihan tersendiri yang default-nya nonaktif. Urutannya membangun aset sebelum PHPUnit. Suite bawaan dipertahankan dengan identifier domain yang disesuaikan, tetapi belum dijalankan atau dinyatakan lulus untuk domain ini. Lint dan audit juga belum dijalankan. Migrasi/setup, build, kompilasi view/cache, dan format PHP merupakan persiapan development.

Testing tidak dijalankan karena belum diminta secara eksplisit. QA browser, login, chat, konsultasi end-to-end, LLM/TTS/SMTP nyata belum dicoba. Build aset, migrasi SQLite dan PostgreSQL, kompilasi view/cache, format PHP, serta deployment Toolkit berhasil pada sesi 20 Oktober 2026. Commit, push branch `main`, repository publik, dan deployment telah diizinkan pengguna; perubahan produksi berikutnya tetap mengikuti batas izin yang disepakati.

Aset hasil built-in imagegen tersimpan di `public/images/scenes/{office,lab,meeting}.png` dan `public/images/character/consultant.png`. Prompt aset dicatat di `public/images/artwork-prompts.json`.
