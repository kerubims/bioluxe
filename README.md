# 🌿 Sistem POC (Pupuk Organik Cair)

Sistem manajemen operasional produksi **Pupuk Organik Cair (POC)** berbasis web. Dibangun dengan Laravel 13, Tailwind CSS, dan Alpine.js. Mengelola siklus lengkap dari pembelian bahan baku (sampah organik) hingga penjualan produk POC.

## 📋 Fitur Utama

- **Dashboard** — Ringkasan statistik, grafik penjualan interaktif (Chart.js), dan notifikasi stok menipis
- **Manajemen Supplier** — CRUD data pemasok bahan baku
- **Pembelian Sampah** — Pencatatan transaksi pembelian sampah organik dengan cetak invoice
- **Batch Produksi** — Pelacakan proses fermentasi dari awal hingga panen, termasuk log aktivitas
- **Produk & Inventory** — Manajemen katalog produk POC dan riwayat mutasi stok
- **POS (Point of Sale)** — Transaksi penjualan dengan dukungan multi-item dan cetak struk
- **Laporan** — Preview dan cetak laporan penjualan, pembelian, dan produksi
- **Notifikasi** — Peringatan otomatis masa panen (H-3, H-2, H-1) via notifikasi lonceng
- **Manajemen User & Role** — Multi-role (Admin, Staff Produksi, Kasir) menggunakan Spatie Permission

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | PHP 8.3+, Laravel 13 |
| Frontend | Tailwind CSS 3, Alpine.js, Vite, Chart.js (CDN) |
| Database | MySQL / SQLite |
| Auth & Roles | Laravel Breeze, Spatie Laravel Permission |
| PDF | Barryvdh Laravel DomPDF |
| Export | Maatwebsite Excel |

## ⚙️ Prasyarat (Prerequisites)

Pastikan perangkat Anda sudah memiliki:

- **PHP** >= 8.3 (dengan ekstensi: `mbstring`, `xml`, `ctype`, `json`, `bcmath`, `tokenizer`, `gd`)
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm** >= 9.x
- **MySQL** >= 8.0 (atau **SQLite** untuk pengembangan lokal)
- **Git**

> 💡 **Tips:** Jika menggunakan [Laragon](https://laragon.org/) (Windows) atau [Herd](https://herd.laravel.com/) (macOS), semua prasyarat di atas sudah tersedia secara otomatis.

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/your-username/sistem-poc.git
cd sistem-poc
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file environment dan sesuaikan konfigurasi database:

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan bagian database:

```env
# Untuk MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_poc
DB_USERNAME=root
DB_PASSWORD=

# Atau untuk SQLite (tanpa perlu MySQL):
# DB_CONNECTION=sqlite
```

> ⚠️ Jika menggunakan MySQL, buat database `sistem_poc` terlebih dahulu melalui phpMyAdmin atau terminal:
> ```sql
> CREATE DATABASE sistem_poc;
> ```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

Perintah ini akan:
- Membuat semua tabel yang dibutuhkan
- Membuat role & permission (Admin, Staff Produksi, Kasir)
- Membuat akun admin default
- Mengisi data awal (kategori sampah, produk, pengaturan)

### 6. Install Dependensi Frontend

```bash
npm install
```

### 7. Build Asset (CSS & JS)

```bash
# Untuk development (dengan hot-reload):
npm run dev

# Untuk production:
npm run build
```

## ▶️ Menjalankan Aplikasi

Buka **2 terminal** secara bersamaan:

**Terminal 1** — Jalankan Laravel server:
```bash
php artisan serve
```

**Terminal 2** — Jalankan Vite dev server (hot-reload):
```bash
npm run dev
```

Atau gunakan satu perintah untuk menjalankan semuanya sekaligus:
```bash
composer dev
```

Aplikasi akan berjalan di: **http://localhost:8000**

## 🔐 Akun Default

Setelah menjalankan seeder, Anda bisa login dengan akun berikut:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@sistem-poc.test` | `password` |

> Untuk menambahkan akun Staff Produksi atau Kasir, login sebagai Admin lalu buka menu **Manajemen User**.

## 📅 Scheduler (Notifikasi Otomatis)

Agar fitur notifikasi peringatan masa panen berjalan otomatis, tambahkan cron job berikut di server:

```bash
* * * * * cd /path-to/sistem-poc && php artisan schedule:run >> /dev/null 2>&1
```

Untuk pengembangan lokal, jalankan secara manual:

```bash
php artisan schedule:work
```

## 📂 Struktur Direktori Utama

```
sistem-poc/
├── app/
│   ├── Http/Controllers/     # Controller untuk setiap modul
│   ├── Models/               # Eloquent Model
│   └── Notifications/        # Notifikasi masa panen
├── database/
│   ├── migrations/           # Skema tabel database
│   └── seeders/              # Data awal (role, admin, produk)
├── resources/views/
│   ├── layouts/              # Layout utama (sidebar, app)
│   ├── dashboard.blade.php   # Halaman dashboard
│   ├── customers/            # CRUD Customer
│   ├── suppliers/            # CRUD Supplier
│   ├── products/             # CRUD Produk
│   ├── sales/                # POS & Transaksi Penjualan
│   ├── waste_purchases/      # Pembelian Sampah
│   ├── production_batches/   # Batch Produksi
│   └── reports/              # Laporan
├── routes/
│   ├── web.php               # Route utama
│   └── console.php           # Scheduler
└── public/
    └── images/               # Aset gambar (logo, dll)
```

## 🧹 Perintah Berguna

```bash
# Bersihkan semua cache
php artisan optimize:clear

# Reset database & seed ulang
php artisan migrate:fresh --seed

# Jalankan notifikasi panen secara manual
php artisan app:check-harvest-deadline

# Cek route yang terdaftar
php artisan route:list
```

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
