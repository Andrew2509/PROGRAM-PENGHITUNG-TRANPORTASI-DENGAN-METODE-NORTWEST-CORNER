<p align="center">
  <img src="./public/Test/images/logo.png" width="400" alt="Logo Proyek Anda">
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>


# Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner

Aplikasi ini merupakan sistem berbasis web yang dirancang untuk menghitung solusi awal masalah transportasi menggunakan **metode Northwest Corner**, bertujuan menyederhanakan proses alokasi distribusi supply dan demand dengan efisien dan akurat.

---

## 🧭 Tujuan Proyek

- Mengotomatisasi perhitungan alokasi awal distribusi barang berdasarkan supply dan demand.
- Menyediakan antarmuka input yang fleksibel dan mudah digunakan.
- Menghasilkan output berupa tabel alokasi dan total biaya transportasi.
- Menyediakan fitur ekspor hasil perhitungan ke PDF dan CSV.

---

## 🔧 Fitur Utama

- ✅ Input data **Supply** dan **Demand**.
- ✅ Input **Matriks Biaya Transportasi**.
- ✅ Perhitungan otomatis dengan metode **Northwest Corner**.
- ✅ Tabel hasil alokasi dan total biaya.
- ✅ Validasi input (supply = demand, tidak boleh kosong).
- ✅ Tombol reset dan ekspor hasil (PDF/CSV).
- ✅ Halaman bantuan/tutorial.

---

## ⚙️ Teknologi yang Digunakan

- **Laravel 10**
- **Livewire (komponen interaktif tanpa reload)**
- **Blade Templates**
- **MySQL**
- **HTML5, CSS3, JavaScript**

---

---

## 🗂 Struktur Folder Utama

```
app/
├── Livewire/
│   ├── Auth/
│   │   ├── Login.php
│   │   └── Bantuan.php
│   ├── DemandTable.php
│   ├── SupplyTable.php
│   └── Transportation.php

public/
└── Test/
    ├── css/
    │   ├── bantuan.css
    │   ├── login.css
    │   └── style.css
    └── js/
        └── script.js

resources/
└── views/
    ├── components/
    │   ├── layouts/
    │   │   └── app.blade.php
    │   ├── demand-table.blade.php
    │   └── supply-table.blade.php
    └── livewire/
        ├── auth/
        │   └── login.blade.php
        ├── bantuan.blade.php
        └── transportation.blade.php
```

---

## 🧮 Contoh Input & Output

![Contoh Input](./screenshots/input.png)
![Contoh Output](./screenshots/output.png)

---

## 🧪 Instalasi & Menjalankan Proyek

1. **Clone repositori:**
   ```bash
   git clone https://github.com/yourusername/yourproject.git
   cd yourproject
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Atur file `.env`:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Atur koneksi database di `.env` lalu jalankan migrasi dan seeder:**
   ```bash
   php artisan migrate --seed
   ```

5. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```

> Catatan: Username dan password telah tersedia di database melalui proses seeding.

---

## ✅ Validasi & Verifikasi

Semua kebutuhan fungsional telah diuji dan berjalan sesuai ekspektasi, termasuk:
- Validasi supply = demand.
- Form input numerik.
- Algoritma Northwest Corner bekerja tanpa error.
- Output valid dan dapat diekspor.

---

## 📚 Referensi

- Taha, H. A. (2017). *Operations Research: An Introduction*. Pearson.
- Wang, Y., et al. (2019). *Transportation Cost Analysis in Supply Chain Management*. *Journal of Logistics*.
- Bowers, S., et al. (2020). *Educational Tools for Logistics and Supply Chain Management*.

---

## 👨‍💻 Kontributor

- **Andrew** – Desain Input & Tampilan
- **Noval** – Logika Algoritma & Output

---

## 📜 Lisensi

Proyek ini dibuat untuk keperluan akademik (UAS Rekayasa Perangkat Lunak) dan tidak dimaksudkan untuk digunakan di lingkungan produksi.


---

## 🔐 Langkah Login

Setelah menjalankan server lokal (`php artisan serve`), Anda dapat mengakses aplikasi melalui browser di alamat:

```
http://127.0.0.1:8000
```

Gunakan kredensial berikut untuk login ke sistem:

- **Username:** `admin`
- **Password:** `12345678`

Jika login berhasil, Anda akan diarahkan ke halaman perhitungan transportasi.
