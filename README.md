# ⚽ SewaStadion — Sistem Manajemen Penyewaan Stadion

> Sistem informasi penyewaan lapangan dan manajemen pemesanan berbasis web untuk Stadion Sultan Agung Bantul. Dibangun untuk mendigitalisasi proses pemesanan, mengelola jadwal, dan menyederhanakan operasional administratif bagi Dikpora Bantul.

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
</p>

---

## 📖 Overview

SewaStadion adalah aplikasi web full-stack yang dirancang untuk mengelola proses penyewaan lapangan di **Stadion Sultan Agung, Bantul**. Platform ini memecahkan masalah alur kerja pemesanan manual dengan menyediakan solusi digital end-to-end — mulai dari melihat ketersediaan lapangan, pengajuan pesanan, persetujuan admin, verifikasi pembayaran, hingga pembuatan tiket PDF dengan kode QR.

Sistem ini melayani dua peran pengguna utama: **Penyewa (Tenant)** yang dapat menelusuri lapangan yang tersedia, melakukan pemesanan, mengunggah bukti pembayaran, dan mengunduh tiket; dan **Administrator** yang mengelola stadion, mengatur harga sewa, menyetujui/menolak pesanan, mengelola pengguna, serta memantau pendapatan melalui dashboard analitik.

---

## ✨ Fitur Utama

- 🔐 **Autentikasi & Otorisasi Berbasis Peran** — Registrasi pengguna, login, dan kontrol akses berbasis peran (Admin & Penyewa) yang dilindungi oleh middleware
- 🏟️ **Manajemen Stadion (CRUD)** — Admin dapat membuat, mengedit, menghapus, dan mengelola lapangan stadion lengkap dengan unggahan foto dan status
- 📅 **Sistem Pemesanan Cerdas** — Pemesanan berdasarkan slot waktu (Pagi-Siang, Siang-Sore, Malam, Full-Day) dengan deteksi bentrok jadwal otomatis untuk mencegah pemesanan ganda
- 💰 **Sistem Harga Dinamis** — Tarif sewa yang dapat dikonfigurasi untuk setiap stadion dan kondisi waktu, dengan kalkulasi total harga otomatis melalui AJAX
- 📊 **Dashboard Analitik Admin** — Statistik pendapatan (harian, bulanan, difilter berdasarkan rentang tanggal) dengan visualisasi grafik dinamis
- ✅ **Alur Persetujuan Pesanan** — Admin dapat menyetujui, menolak, atau menandai pesanan selesai dengan pelacakan status
- 💳 **Unggah Bukti Pembayaran** — Penyewa dapat mengunggah bukti pembayaran; admin memverifikasi sebelum menyelesaikan pesanan
- 🎫 **Tiket PDF dengan QR Code** — Membuat tiket PDF yang dapat diunduh lengkap dengan kode QR untuk pesanan yang telah selesai
- 📋 **Penampil Jadwal** — Pengecekan ketersediaan secara real-time dengan indikator tanggal yang dipesan penuh/sebagian
- 👥 **Manajemen Pengguna** — Admin dapat menambahkan pengguna, mengubah peran admin, mengaktifkan/menonaktifkan akun, dan menghapus pengguna
- 📱 **Desain Responsif** — Antarmuka ramah seluler dengan dukungan mode gelap (dark mode)
- 🔔 **Notifikasi SweetAlert** — Umpan balik interaktif untuk tindakan pengguna di seluruh aplikasi

---

## 🖥️ Tinjauan Aplikasi (Application Preview)

![Landing Page](./docs/screenshots/landing-page.jpg)

Rekomendasi screenshot lain yang perlu Anda tambahkan:

| Prioritas | Halaman | Deskripsi | Status |
|:---:|:---|:---|:---|
| 1 | Landing Page | Bagian hero dengan gambar stadion | ✅ Selesai |
| 2 | Admin Dashboard | Grafik pendapatan dan kartu statistik | `[SCREENSHOT NEEDED]` |
| 3 | Form Pemesanan | Pemilihan slot waktu dan harga | `[SCREENSHOT NEEDED]` |
| 4 | Pesanan Saya | Daftar pesanan penyewa dengan status | `[SCREENSHOT NEEDED]` |
| 5 | Manajemen Pesanan Admin | Alur persetujuan/penolakan | `[SCREENSHOT NEEDED]` |
| 6 | Manajemen Stadion | Daftar CRUD dengan gambar | `[SCREENSHOT NEEDED]` |

> **Cara Menambahkan Screenshot:** 
> 1. Buka aplikasi Anda di browser.
> 2. Ambil screenshot untuk halaman-halaman di atas.
> 3. Simpan file screenshot di dalam folder `docs/screenshots/`.
> 4. Perbarui Markdown di bagian ini (misalnya `![Admin Dashboard](./docs/screenshots/admin-dashboard.png)`).

---

## 🛠️ Tech Stack

### Frontend
| Teknologi | Kegunaan |
|:---|:---|
| Blade Templates | Mesin templating sisi server |
| Tailwind CSS 3.4 | Framework CSS utility-first |
| Alpine.js 3 | JavaScript reaktif yang ringan |
| Flowbite | Library komponen UI untuk Tailwind |
| SweetAlert2 | Dialog notifikasi interaktif |
| jQuery | Permintaan AJAX dan manipulasi DOM |

### Backend
| Teknologi | Kegunaan |
|:---|:---|
| Laravel 12 | Framework aplikasi web PHP |
| PHP 8.2+ | Bahasa pemrograman sisi server |
| Laravel Breeze | Scaffolding autentikasi |
| DomPDF | Pembuatan dokumen PDF |
| Simple QR Code | Pembuatan kode QR untuk tiket |

### Database
| Teknologi | Kegunaan |
|:---|:---|
| MySQL | Database relasional utama |

### Build Tools
| Teknologi | Kegunaan |
|:---|:---|
| Vite 6 | Bundling aset frontend dan HMR |
| Laragon | Lingkungan pengembangan lokal |

---

## 🏗️ Arsitektur

Aplikasi ini menggunakan arsitektur **Monolithic MVC (Model-View-Controller)** dengan pendekatan server-side rendering menggunakan Blade templates dari Laravel.

```text
Pengguna (Browser)
     ↓
Blade Templates + Alpine.js + Tailwind CSS
     ↓
Router Laravel (web.php / auth.php)
     ↓
Middleware (Auth, Admin)
     ↓
Controllers
├── StadionController        → CRUD Stadion + Logika Dashboard
├── PenyewaanStadionController → Alur pemesanan + Tiket PDF
├── HargaSewaController      → Manajemen harga sewa
├── UserController           → Manajemen pengguna
└── ProfileController        → Manajemen profil pengguna
     ↓
Eloquent Models
├── User            (hasMany → Stadion, PenyewaanStadion)
├── Stadion         (hasMany → PenyewaanStadion, HargaSewa)
├── PenyewaanStadion (belongsTo → User, Stadion)
└── HargaSewa       (belongsTo → Stadion)
     ↓
Database MySQL
```

**Keputusan Arsitektur Utama:**
- Rendering sisi server (Server-side rendering) dengan Blade (bukan SPA / tidak ada API terpisah)
- Akses berbasis peran menggunakan middleware kustom `Admin`
- Pemesanan berbasis slot waktu dengan algoritma deteksi bentrok jadwal
- Rendering grafik dinamis berdasarkan filter rentang tanggal (harian vs bulanan)

---

## 📂 Struktur Proyek

```text
SewaStadion/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Pengendali (Controller) aplikasi
│   │   ├── Middleware/         # Middleware kustom (Admin)
│   │   └── Requests/          # Validasi form request
│   ├── Models/                # Model Eloquent (User, Stadion, PenyewaanStadion, HargaSewa)
│   ├── Providers/             # Penyedia layanan (Service providers)
│   └── View/                  # Komponen tampilan
├── database/
│   ├── migrations/            # Skema database (14 file migrasi)
│   └── seeders/               # AdminUserSeeder untuk akun admin awal
├── resources/
│   └── views/
│       ├── admin/             # Dashboard Admin
│       ├── user/              # Dashboard & index Penyewa
│       ├── stadion/           # Tampilan CRUD Stadion
│       ├── harga-sewa/        # Tampilan harga sewa
│       ├── penyewaan-stadion/ # Tampilan pemesanan (Admin & Penyewa)
│       ├── layouts/           # Layout aplikasi, navigasi, footer
│       ├── components/        # Komponen Blade yang dapat digunakan ulang
│       ├── auth/              # Tampilan autentikasi (Breeze)
│       ├── profile/           # Tampilan manajemen profil
│       └── welcome.blade.php  # Landing page
├── routes/
│   ├── web.php                # Rute aplikasi
│   └── auth.php               # Rute autentikasi (Breeze)
├── public/                    # Aset publik dan symlink storage
├── tests/                     # File pengujian PHPUnit
├── composer.json              # Dependensi PHP
├── package.json               # Dependensi Node.js
├── tailwind.config.js         # Konfigurasi Tailwind CSS
└── vite.config.js             # Konfigurasi build Vite
```

---

## ⚙️ Instalasi & Setup

### Prasyarat

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL
- Git

### Langkah 1: Kloning Repositori

```bash
git clone https://github.com/wawanpi/SewaStadion.git
cd SewaStadion
```

### Langkah 2: Instal Dependensi

```bash
composer install
npm install
```

### Langkah 3: Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan konfigurasikan koneksi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sewa_stadion
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 4: Setup Database

Buat database MySQL dengan nama `sewa_stadion`, lalu jalankan:

```bash
php artisan migrate --seed
```

Perintah ini akan membuat semua tabel dan mengisi data akun admin bawaan (default).

### Langkah 5: Storage Link

```bash
php artisan storage:link
```

### Langkah 6: Jalankan Server Pengembangan (Development Server)

Anda harus menjalankan server Laravel dan server Vite secara bersamaan:

**Terminal 1 — Laravel:**
```bash
php artisan serve
```

**Terminal 2 — Vite (kompilasi aset):**
```bash
npm run dev
```

Atau gunakan perintah konkuren bawaan:

```bash
composer run dev
```

Aplikasi akan berjalan di `http://localhost:8000`

### Akun Admin Bawaan (Default)

| Field | Nilai |
|:---|:---|
| Email | `admin@gmail.com` |
| Password | `password123` |

> ⚠️ **Segera ubah password admin default setelah Anda berhasil login pertama kali.**

---

## 🔐 Environment Variables

| Variabel | Deskripsi | Wajib |
|:---|:---|:---:|
| `APP_KEY` | Kunci enkripsi aplikasi Laravel | Ya |
| `DB_CONNECTION` | Driver database (`mysql`) | Ya |
| `DB_HOST` | Host database | Ya |
| `DB_PORT` | Port database | Ya |
| `DB_DATABASE` | Nama database | Ya |
| `DB_USERNAME` | Username database | Ya |
| `DB_PASSWORD` | Password database | Ya |
| `MAIL_MAILER` | Driver email untuk notifikasi | Tidak |
| `MAIL_HOST` | Host server email | Tidak |
| `MAIL_PORT` | Port server email | Tidak |
| `MAIL_USERNAME` | Username server email | Tidak |
| `MAIL_PASSWORD` | Password server email | Tidak |
| `QUEUE_CONNECTION` | Driver antrean (`database`) | Tidak |

---

## 🧪 Pengujian (Testing)

Proyek ini mencakup test suite bawaan Laravel Breeze (Pengujian Auth dan Profil):

```bash
php artisan test
```

> Pengujian fitur tambahan untuk pemesanan, harga, dan manajemen stadion belum disertakan saat ini.

---

## 🚀 Deployment

Aplikasi ini dapat di-deploy di server apa pun yang mendukung:

- PHP 8.2+
- MySQL
- Composer
- Node.js (untuk build aset)

**Build aset produksi sebelum melakukan deployment:**

```bash
npm run build
```

> Konfigurasi spesifik platform deployment (seperti Docker, Railway, dll.) belum disertakan dalam repositori ini.

---

## 🌐 Live Demo

Coming soon.

---

## 👨‍💻 Developer

**[NEED INFO]** — Nama Developer dan informasi pendidikan

- GitHub: [wawanpi](https://github.com/wawanpi)
- LinkedIn: `[NEED INFO]`
- Portfolio: `[NEED INFO]`

---

## 📄 Lisensi (License)

Proyek ini saat ini belum menyertakan file lisensi.

---

<p align="center">
  Dibuat dengan ❤️ menggunakan Laravel 12
</p>
