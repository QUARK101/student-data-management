# SIMAKA — Sistem Informasi Data Mahasiswa

![Laravel](https://img.shields.io/badge/Laravel-13-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey?logo=sqlite)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?logo=bootstrap)

Proyek UTS Mata Kuliah **Pemrograman Web Fullstack**

| Info | Detail |
|------|--------|
| **Nama** | Muhammad Hafidz Rifai |
| **NIM** | 2305101077 |
| **Universitas** | Universitas PGRI Madiun |
| **Mata Kuliah** | Praktikum Pemrograman Web Fullstack |

---

## Deskripsi

SIMAKA adalah sistem informasi berbasis web untuk mengelola data mahasiswa
dan program studi. Dibangun menggunakan framework **Laravel 13** dengan
arsitektur **MVC (Model-View-Controller)** dan dilengkapi dengan **REST API**.

---

## Fitur

- **Dashboard Statistik** — Total mahasiswa, statistik per status & per program studi
- **CRUD Mahasiswa** — Tambah, lihat, edit, dan hapus data mahasiswa
- **CRUD Program Studi** — Kelola data program studi
- **Filter & Search** — Filter berdasarkan prodi & status, cari berdasarkan nama/NIM
- **Badge Status** — Tampilan badge warna untuk status mahasiswa (Aktif, Cuti, Lulus, Keluar)
- **Konfirmasi Hapus** — Dialog konfirmasi menggunakan SweetAlert2
- **Paginasi** — Navigasi halaman dengan Bootstrap 5
- **REST API** — Endpoint API untuk data mahasiswa

---

## Tech Stack

| Teknologi     | Versi | Keterangan         |
|---------------|-------|--------------------|
| PHP           | 8.3   | Backend language   |
| Laravel       | 13    | PHP Framework      |
| SQLite        | -     | Database           |
| Bootstrap     | 5.3   | CSS Framework (CDN)|
| Tailwind CSS  | v4    | Utility CSS        |
| Font Awesome  | 6.4   | Icon library (CDN) |
| SweetAlert2   | 11    | Alert library (CDN)|
| Vite          | 6     | Asset bundler      |

---

## Struktur Database

### Tabel `program_studi`

| Kolom      | Tipe    | Keterangan              |
|------------|---------|-------------------------|
| id         | integer | Primary key             |
| nama       | string  | Nama program studi      |
| jenjang    | string  | S1 / D3 / D4            |
| fakultas   | string  | Nama fakultas           |
| timestamps | -       | created_at, updated_at  |

### Tabel `mahasiswa`

| Kolom            | Tipe    | Keterangan                      |
|------------------|---------|---------------------------------|
| id               | integer | Primary key                     |
| program_studi_id | integer | Foreign key → program_studi     |
| nama             | string  | Nama lengkap mahasiswa          |
| nim              | string  | NIM (unique)                    |
| email            | string  | Email (nullable, unique)        |
| no_hp            | string  | Nomor HP (nullable)             |
| angkatan         | integer | Tahun angkatan                  |
| status           | enum    | Aktif / Cuti / Lulus / Keluar   |
| alamat           | text    | Alamat lengkap                  |
| timestamps       | -       | created_at, updated_at          |

---

## REST API Endpoints

| Method | Endpoint              | Deskripsi                              |
|--------|-----------------------|----------------------------------------|
| GET    | `/api/mahasiswa`      | Ambil semua data mahasiswa             |
| GET    | `/api/mahasiswa/{id}` | Ambil data mahasiswa berdasarkan ID    |

### Contoh Response `/api/mahasiswa`

    {
      "data": [
        {
          "id": 1,
          "nama": "Muhammad Hafidz Rifai",
          "nim": "2305101077",
          "email": "hafidz@example.com",
          "no_hp": "081234567890",
          "angkatan": 2023,
          "status": "Aktif",
          "alamat": "Madiun, Jawa Timur",
          "program_studi": {
            "id": 1,
            "nama": "Teknik Informatika",
            "jenjang": "S1",
            "fakultas": "Fakultas Teknik"
          }
        }
      ]
    }

---

## Cara Instalasi & Menjalankan

### Prasyarat

Pastikan sudah terinstall:
- PHP >= 8.3
- Composer
- Node.js >= 18
- Git

### Langkah Instalasi

**1. Clone repository**

    git clone https://github.com/QUARK101/student-data-management.git
    cd student-data-management

**2. Install dependensi PHP**

    composer install

**3. Install dependensi Node.js**

    npm install

**4. Salin file environment**

    cp .env.example .env
    php artisan key:generate

**5. Jalankan migrasi & seeder**

    php artisan migrate --seed

**6. Build assets**

    npm run build

**7. Jalankan server**

    php artisan serve

**8. Buka di browser**

    http://localhost:8000

---

## Struktur Folder (MVC)

    sistem-informasi-mahasiswa/
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   │   ├── Api/
    │   │   │   │   └── MahasiswaApiController.php
    │   │   │   ├── DashboardController.php
    │   │   │   ├── MahasiswaController.php
    │   │   │   └── ProgramStudiController.php
    │   │   └── Resources/
    │   │       └── MahasiswaResource.php
    │   └── Models/
    │       ├── Mahasiswa.php
    │       └── ProgramStudi.php
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── resources/
    │   └── views/
    │       ├── layouts/
    │       │   └── app.blade.php
    │       ├── mahasiswa/
    │       │   ├── index.blade.php
    │       │   ├── create.blade.php
    │       │   ├── edit.blade.php
    │       │   └── show.blade.php
    │       ├── program_studi/
    │       │   ├── index.blade.php
    │       │   ├── create.blade.php
    │       │   └── edit.blade.php
    │       └── dashboard.blade.php
    ├── routes/
    │   ├── api.php
    │   └── web.php
    └── README.md

---

## Lisensi

Proyek ini dibuat untuk keperluan akademik — UTS Mata Kuliah Pemrograman
Web Fullstack, Universitas PGRI Madiun.
