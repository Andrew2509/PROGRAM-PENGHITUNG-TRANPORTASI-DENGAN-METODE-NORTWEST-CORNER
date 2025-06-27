# Sistem Penghitungan Biaya Transportasi - Metode Northwest Corner

<p align="center">
  <img src="./public/Test/Image/logo.png" alt="Logo Sistem" width="200" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
</p>

<div align="center">
  <a href="#-tujuan-proyek">Tujuan</a> •
  <a href="#-fitur-utama">Fitur</a> •
  <a href="#-teknologi-yang-digunakan">Teknologi</a> •
  <a href="#-tampilan-sistem">Tampilan</a> •
  <a href="#-instalasi--menjalankan-proyek">Instalasi</a> •
  <a href="#-kontributor">Kontributor</a>
</div>

---

## 🧭 Tujuan Proyek

- Mengotomatisasi perhitungan alokasi awal distribusi barang berdasarkan supply dan demand
- Menyediakan antarmuka input yang fleksibel dan mudah digunakan
- Menghasilkan output berupa tabel alokasi dan total biaya transportasi
- Menyediakan fitur ekspor hasil perhitungan ke PDF dan CSV

---

## 🔧 Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 📊 **Input Data** | Input data Supply, Demand, dan Matriks Biaya Transportasi |
| 🧮 **Perhitungan Otomatis** | Algoritma Northwest Corner untuk alokasi optimal |
| ✅ **Validasi Data** | Pemeriksaan kesamaan supply dan demand |
| 💾 **Ekspor Data** | Ekspor hasil ke format PDF dan CSV |
| 🔄 **Manajemen Kasus** | Tambah, edit, dan reset kasus perhitungan |
| ❓ **Panduan Penggunaan** | Halaman bantuan/tutorial lengkap |

---

## ⚙️ Teknologi yang Digunakan

**Backend:**
- Laravel 10
- Livewire
- MySQL

**Frontend:**
- Blade Templates
- HTML5
- CSS3
- JavaScript

**Lainnya:**
- Composer
- npm
- Git

---

## 🖼 Tampilan Sistem

### Halaman Login
![Halaman Login](./public/Test/Image/login.png)

### Halaman Utama Transportasi
![Halaman Utama](./public/Test/Image/tampulan-utama.png)

### Penambahan Kasus Baru
![Tambah Kasus](./public/Test/Image/tambah-kasus.png)

### Contoh Input & Output
| Input Data | Hasil Perhitungan |
|------------|-------------------|
| ![Contoh Input](./public/Test/Image/Input.png) | ![Contoh Output](./public/Test/Image/Output.png) |

### Panduan Sistem
![Panduan Sistem](./public/Test/Image/panduan.png)

---

## 🛠 Instalasi & Menjalankan Proyek

```bash
# Clone repositori
git clone https://github.com/Andrew2509/PROGRAM-PENGHITUNG-TRANPORTASI-DENGAN-METODE-NORTWEST-CORNER.git
cd PROGRAM-PENGHITUNG-TRANPORTASI-DENGAN-METODE-NORTWEST-CORNER

# Install dependencies
composer install
npm install && npm run dev

# Konfigurasi environment
cp .env.example .env
php artisan key:generate

# Setup database (ubah konfigurasi di .env terlebih dahulu)
php artisan migrate --seed

# Jalankan server
php artisan serve
```

**Kredensial Login:**
```
Username: admin
Password: 12345678
```

Akses aplikasi di: http://localhost:8000

---

## 👨‍💻 Kontributor

| Nama | NIM | Peran |
|------|-----|-------|
| **Princenton Andrew Brightly Masrikat** | 1462100248 | Desain Input & Tampilan |
| **Nouval B. Saputra** | 1462100264 | Logika Algoritma & Output |

---

## 📚 Referensi
1. Taha, H. A. (2017). *Operations Research: An Introduction*. Pearson.
2. Wang, Y., et al. (2019). *Transportation Cost Analysis in Supply Chain Management*.
3. Bowers, S., et al. (2020). *Educational Tools for Logistics and Supply Chain Management*.

---

## 📜 Lisensi
Proyek ini dibuat untuk keperluan akademik (UAS Pengujian Perangkat Lunak) dan tidak dimaksudkan untuk digunakan di lingkungan produksi.

---

<p align="center">
  © 2023 Sistem Penghitungan Biaya Transportasi | Metode Northwest Corner
</p>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  h1, h2, h3 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
  }
  
  th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    background-color: #f8f9fa;
  }
  
  tr:hover {
    background-color: #f5f5f5;
  }
  
  code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
    font-family: 'Fira Code', monospace;
  }
  
  pre {
    background: #2c3e50;
    color: #ecf0f1;
    padding: 15px;
    border-radius: 8px;
    overflow-x: auto;
  }
  
  img {
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  
  a {
    color: #3498db;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
</style>
