# Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner

<p align="center">
  <img src="./public/Test/Image/logo.png" alt="Logo Sistem" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
</p>

<div align="center">
  <a href="#tujuan-proyek">Tujuan</a> •
  <a href="#fitur-utama">Fitur</a> •
  <a href="#teknologi-yang-digunakan">Teknologi</a> •
  <a href="#tampilan-sistem">Tampilan</a> •
  <a href="#instalasi--menjalankan-proyek">Instalasi</a> •
  <a href="#kontributor">Kontributor</a>
</div>

---

## 🧭 Tujuan Proyek
Menyediakan solusi efisien untuk perhitungan biaya transportasi menggunakan metode Northwest Corner dengan:
- Mengotomatisasi perhitungan alokasi distribusi barang
- Menyediakan antarmuka input yang fleksibel dan intuitif
- Menghasilkan tabel alokasi dan total biaya transportasi
- Menyediakan fitur ekspor hasil ke PDF dan CSV

---

## 🔧 Fitur Utama
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 30px 0;">
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3>📊 Input Data</h3>
    <ul>
      <li>Input Supply dan Demand</li>
      <li>Matriks Biaya Transportasi</li>
      <li>Validasi data (supply = demand)</li>
    </ul>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3>🧮 Perhitungan Otomatis</h3>
    <ul>
      <li>Metode Northwest Corner</li>
      <li>Tabel hasil alokasi</li>
      <li>Total biaya transportasi</li>
    </ul>
  </div>
  
  <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3>💾 Ekspor Data</h3>
    <ul>
      <li>Ekspor ke PDF</li>
      <li>Ekspor ke CSV</li>
      <li>Tombol reset data</li>
    </ul>
  </div>
</div>

---

## ⚙️ Teknologi yang Digunakan
<div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; margin: 30px 0;">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
</div>

---

## 🖼 Tampilan Sistem

### Halaman Login
<div style="text-align: center;">
  <img src="./public/Test/Image/login.png" alt="Halaman Login" style="max-width: 80%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin: 20px 0;">
</div>

### Halaman Utama Transportasi
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin: 30px 0;">
  <div>
    <img src="./public/Test/Image/tampulan-utama.png" alt="Halaman Utama" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
  <div>
    <img src="./public/Test/Image/tambah-kasus.png" alt="Tambah Kasus" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
</div>

### Contoh Input & Output
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin: 30px 0;">
  <div>
    <img src="./public/Test/Image/Input.png" alt="Contoh Input" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
  <div>
    <img src="./public/Test/Image/Output.png" alt="Contoh Output" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
</div>

### Panduan Sistem
<div style="text-align: center;">
  <img src="./public/Test/Image/panduan.png" alt="Panduan Sistem" style="max-width: 80%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin: 20px 0;">
</div>

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

# Setup database (atur di .env terlebih dahulu)
php artisan migrate --seed

# Jalankan server
php artisan serve
```

Setelah server berjalan, akses aplikasi di `http://localhost:8000` dan login dengan:
- **Username:** `admin`
- **Password:** `12345678`

---

## 👨‍💻 Kontributor

| Nama | NIM | Peran |
|------|-----|-------|
| **Princenton Andrew Brightly Masrikat** | 1462100248 | Desain Input & Tampilan |
| **Nouval B. Saputra** | 1462100264 | Logika Algoritma & Output |

---

## 📜 Lisensi
Proyek ini dibuat untuk keperluan akademik (UAS Pengujian Perangkat Lunak) dan tidak dimaksudkan untuk digunakan di lingkungan produksi.

<div style="text-align: center; margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
  <p>© 2023 Sistem Penghitungan Biaya Transportasi</p>
</div>
