# **Product Requirements Document (PRD)**

**Nama Proyek:** Rancang Bangun Aplikasi Web Pengolahan Sampah Organik Menjadi POC **Platform:** Web Application (Laravel Framework) **Versi Dokumen:** 1.2

## **1\. Ringkasan Eksekutif (Executive Summary)**

Aplikasi ini bertujuan untuk mendigitalisasi proses bisnis pengolahan sampah organik menjadi Pupuk Organik Cair (POC). Sistem ini akan mencatat pembelian sampah dari masyarakat/pengepul, melacak proses produksi (fermentasi) berdasarkan *batch*, mengelola stok bahan dan hasil jadi, serta memfasilitasi transaksi penjualan POC ke konsumen.

## **2\. Target Pengguna (User Personas)**

Sistem ini akan memiliki beberapa peran (Role) pengguna:

1. **Admin / Pemilik Usaha:** Memiliki akses penuh ke seluruh sistem, laporan keuangan, dan manajemen pengguna.  
2. **Staf Produksi:** Bertanggung jawab mencatat penerimaan sampah, mengelola *batch* fermentasi, dan mencatat hasil panen POC.  
3. **Pemasok (Masyarakat/Mitra):** (Opsional untuk login) Entitas yang menyetorkan sampah dan menerima pembayaran.  
4. **Pembeli / Konsumen:** Pelanggan yang membeli produk POC (Bisa B2B seperti petani, atau B2C).

## **3\. Fitur Utama & Kebutuhan Fungsional (Functional Requirements)**

### **A. Modul Manajemen Akses & Pengguna**

* **Autentikasi (Ditenagai oleh Laravel Breeze):** Meliputi fitur bawaan seperti Login, Register (untuk peran tertentu), Logout, Lupa Password (Reset Password), dan Manajemen Profil Pengguna.  
* **Manajemen Role & Permission:** Pembatasan hak akses antara Admin, Staf Produksi, dan Pembeli. (Disarankan menggunakan *package* tambahan seperti Spatie Laravel Permission untuk memperluas fungsionalitas Breeze).  
* **Manajemen Data Pemasok & Pembeli:** CRUD (Create, Read, Update, Delete) data profil kontak.

### **B. Modul Transaksi Pembelian (Inbound / Sampah Masuk)**

* **Penerimaan Sampah:** Form input untuk mencatat berat sampah organik yang disetorkan oleh pemasok.  
* **Kategorisasi Sampah:** Membedakan jenis sampah (misal: sisa buah, sayuran, daun) karena bisa mempengaruhi kualitas POC.  
* **Perhitungan Harga Otomatis:** Menghitung total bayar ke pemasok berdasarkan harga per-kg yang diatur admin.  
* **Cetak Struk/Kwitansi:** Bukti transaksi untuk pemasok.

### **C. Modul Manajemen Produksi (Core System)**

* **Pembuatan Batch Produksi:** Memulai proses produksi baru dengan meng-alokasikan bahan baku (sampah organik, air, bioaktivator/EM4, gula merah/molase).  
* **Monitoring Status Produksi:** Melacak status tiap batch (Contoh: *Persiapan \-\> Fermentasi \-\> Panen \-\> Gagal*).  
* **Estimasi Waktu Panen (SLA):** Sistem otomatis menghitung tanggal estimasi panen (misal: 14-21 hari setelah tanggal pembuatan) dan memberikan notifikasi pengingat.  
* **Pencatatan Hasil Panen (Yield):** Saat batch berstatus "Panen", staf memasukkan jumlah liter POC yang berhasil diproduksi. Sisa ampas (pupuk padat) juga bisa dicatat jika dimanfaatkan.

### **D. Modul Manajemen Inventori (Gudang)**

* **Stok Bahan Baku:** Melacak jumlah sampah organik yang belum diproses dan bahan tambahan (EM4, Molase).  
* **Stok Barang Jadi (POC):** Melacak stok POC siap jual (dalam satuan Liter atau Botol).  
* **Kartu Stok (Stock Card):** Histori keluar-masuk barang untuk mencegah kehilangan/kecurangan.

### **E. Modul Transaksi Penjualan (Outbound / Penjualan POC)**

* **Katalog Produk:** Menampilkan varian POC (misal: kemasan 500ml, 1 Liter, 5 Liter, Jerigen).  
* **Point of Sales (POS) Kasir:** Antarmuka cepat untuk staf mencatat penjualan offline.  
* **Manajemen Pesanan (Order):** Mencatat status pembayaran (Lunas/Belum) dan status pengiriman barang.

### **F. Modul Dashboard & Pelaporan (Reporting)**

* **Dashboard Utama:** Menampilkan metrik penting (Total Sampah Terkumpul, Total POC Diproduksi, Pendapatan, Batch Aktif).  
* **Laporan Laba Rugi Sederhana:** Menghitung total penjualan dikurangi biaya pembelian sampah dan bahan.  
* **Laporan Produksi:** Rasio keberhasilan produksi (Berapa kg sampah menghasilkan berapa liter POC).  
* **Export Data:** Fitur download laporan ke PDF atau Excel/CSV.

## **4\. Kebutuhan Non-Fungsional (Non-Functional Requirements)**

1. **Tech Stack:**  
   * **Backend:** Laravel 12\.  
   * **Starter Kit / Autentikasi:** Laravel Breeze (Menyediakan *scaffolding* awal untuk otentikasi).  
   * **Frontend:** Blade Template dengan Alpine.js (Bawaan Breeze) dan Tailwind CSS (Atau menggunakan stack Livewire / Inertia.js sesuai preferensi developer).  
   * **Database:** MySQL  
2. **Keamanan:** Implementasi perlindungan CSRF, XSS, dan SQL Injection (Bawaan Laravel), serta *password hashing*.  
3. **Responsivitas:** Tampilan harus *Mobile-Friendly* karena staf produksi mungkin menginput data menggunakan tablet/smartphone di area pabrik/gudang.

## **5\. Alur Kerja Sistem (System Flow)**

1. **Input:** Masyarakat membawa sampah \-\> Staf menimbang & membayar \-\> Stok bahan baku bertambah.  
2. **Proses:** Staf membuat *Batch Produksi* \-\> Bahan baku berkurang \-\> Sistem memulai *countdown* masa fermentasi.  
3. **Panen:** Masa fermentasi selesai \-\> Staf mencatat hasil panen (Liter) \-\> Stok produk POC bertambah.  
4. **Output:** Ada pembeli datang \-\> Staf memproses transaksi penjualan \-\> Stok produk berkurang \-\> Pemasukan finansial tercatat.

## **6\. Rencana Pengembangan (Roadmap & Fase)**

* **Fase 1 (MVP \- Minimum Viable Product):** Fokus pada pencatatan masuknya sampah, manajemen *batch* produksi dasar, dan pencatatan penjualan manual.  
* **Fase 2 (Penyempurnaan):** Integrasi Payment Gateway (Midtrans/Xendit) untuk penjualan online, notifikasi WhatsApp/Email untuk pengingat masa panen.

## **7\. Rencana Halaman (Sitemap / Page Plan)**

Berikut adalah daftar halaman (UI) yang perlu disiapkan oleh tim developer beserta usulan rutenya:

**A. Halaman Publik & Autentikasi (Disediakan / Dimodifikasi dari Laravel Breeze)**

* GET / : Landing Page (Informasi usaha, kontak, & produk POC).  
* GET /login : Halaman Login pengguna.  
* GET /register : Halaman pendaftaran (Opsional untuk pembeli/pemasok).  
* GET /forgot-password : Halaman Lupa Password.  
* GET /profile : Halaman edit profil & ganti password.

**B. Halaman Admin / Pemilik Usaha**

* GET /admin/dashboard : Dashboard utama (Grafik penjualan, produksi, & ringkasan stok).  
* GET /admin/users : Manajemen Staff & Pengguna (Tabel daftar pengguna, form tambah/edit).  
* GET /admin/settings : Pengaturan Master (Harga beli sampah per kg, kategori sampah, satuan produk).  
* GET /admin/reports : Pusat Laporan (Opsi filter tanggal untuk cetak/ekspor Excel/PDF).

**C. Halaman Staf Produksi & Gudang (Inbound & Core)**

* GET /staff/inbound : Tabel Riwayat penerimaan sampah dari pemasok.  
* GET /staff/inbound/create : Form input penerimaan sampah baru sekaligus pencetakan struk.  
* GET /staff/production : Daftar Batch Produksi (Bisa berupa tabel atau *Kanban Board* untuk melihat status: Persiapan \-\> Fermentasi \-\> Panen).  
* GET /staff/production/create : Form pembuatan Batch baru (Pencatatan alokasi bahan baku).  
* GET /staff/production/{id}/harvest : Form khusus untuk mencatat hasil panen (yield) menjadi Liter/Botol.  
* GET /staff/inventory : Dashboard Inventori (Melihat sisa stok bahan baku & stok produk jadi POC).  
* GET /staff/inventory/stock-card : Kartu Stok (Histori detail keluar masuk barang per *item*).

**D. Halaman Kasir / Penjualan (Outbound)**

* GET /sales/pos : Antarmuka POS (Point of Sales) untuk proses kasir yang cepat (pilih barang, masukkan uang bayar, cetak struk).  
* GET /sales/transactions : Tabel riwayat transaksi penjualan beserta status pembayarannya.

**E. Halaman Pemasok / Pembeli (Opsional / Fase 2\)**

* GET /supplier/dashboard : Halaman riwayat penyetoran sampah (untuk Pemasok).  
* GET /customer/orders : Halaman riwayat pembelian POC (untuk Pembeli/Konsumen).