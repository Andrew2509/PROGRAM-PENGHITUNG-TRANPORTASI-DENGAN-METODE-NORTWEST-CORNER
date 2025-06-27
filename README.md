
# 🚚 Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner

Sistem ini dirancang untuk mempermudah proses perhitungan distribusi logistik menggunakan metode *Northwest Corner*, sebuah metode awal dalam menyelesaikan masalah transportasi. Aplikasi berbasis web ini memungkinkan pengguna untuk memasukkan data supply, demand, serta biaya transportasi antar titik distribusi dan menghitung total biaya secara otomatis.

<p align="center">
  <img src="./public/Test/Image/logo.png" alt="Logo Sistem" width="200">
</p>

## 🧭 Tujuan Proyek
- Mengotomatisasi proses perhitungan biaya transportasi dengan metode Northwest Corner.
- Menyediakan antarmuka yang intuitif untuk input supply, demand, dan matriks biaya.
- Menampilkan hasil alokasi distribusi dan total biaya transportasi secara langsung.
- Menyediakan opsi ekspor hasil ke format PDF dan CSV.

## 🔧 Fitur Utama
- 📊 **Input Data**: Input supply, demand, dan matriks biaya.
- 🧮 **Perhitungan Otomatis**: Algoritma Northwest Corner untuk alokasi distribusi awal.
- 💾 **Ekspor Data**: Hasil alokasi dan biaya dapat disimpan sebagai PDF atau CSV.

## ⚙️ Teknologi yang Digunakan
- Laravel 10
- Livewire
- MySQL
- HTML5, CSS3, JavaScript

## 🖼 Tampilan Sistem

### Halaman Login
![Login](./public/Test/Image/login.png)

### Halaman Utama Transportasi
![Utama](./public/Test/Image/tampulan-utama.png)
![Tambah Kasus](./public/Test/Image/tambah-kasus.png)

### Contoh Input & Output
![Input](./public/Test/Image/Input.png)
![Output](./public/Test/Image/Output.png)

### Panduan Sistem
![Panduan](./public/Test/Image/panduan.png)

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

# Setup database
php artisan migrate --seed

# Jalankan server
php artisan serve
```

Akses aplikasi di `http://localhost:8000`  
**Login**:  
- Username: `admin`  
- Password: `12345678`

## 📁 Struktur Folder
```
app/
├── Livewire/
│   └── Transportation.php     ← Logika metode Northwest Corner

resources/
└── views/
    └── livewire/
        └── transportation.blade.php  ← Tampilan input/output
```

## 📦 Output Program
- Tabel alokasi distribusi berdasarkan metode Northwest Corner
- Total biaya transportasi
- Ekspor hasil ke PDF dan CSV

## 👨‍💻 Kontributor
| Nama              | NIM        | Kontribusi                       |
|-------------------|------------|----------------------------------|
| Princenton Andrew | 1462100248 | Desain Input & Tampilan          |
| Nouval B. Saputra | 1462100264 | Logika Algoritma & Output Sistem |

## 📜 Lisensi
Proyek ini dibuat sebagai bagian dari UAS mata kuliah **Pengujian Perangkat Lunak** dan tidak ditujukan untuk penggunaan produksi.

---

© 2023 Sistem Penghitungan Biaya Transportasi
