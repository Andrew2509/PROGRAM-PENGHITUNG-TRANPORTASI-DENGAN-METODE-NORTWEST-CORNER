# Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner
<p align="center"><a href="https://laravel.com" target="_blank"><img src="./public/Test/Image/logo.png" alt="NCM Logo"></a>
</p>

<p align="center">
    <a href="#tujuan">Tujuan</a>
    <a href="#fitur">Fitur</a>
    <a href="#teknologi">Teknologi</a>
    <a href="#tampilan">Tampilan</a>
    <a href="#instalasi">Instalasi</a>
    <a href="#kontributor">Kontributor</a>
</p>

---

<section id="tujuan">
    <div class="container">
        <h2>🧭 Tujuan Proyek</h2>
        <ul style="list-style:disc;padding-left:24px;font-size:1.05rem">
            <li>Mengotomatisasi perhitungan alokasi distribusi barang</li>
            <li>Menyediakan antarmuka input yang fleksibel dan intuitif</li>
            <li>Menghasilkan tabel alokasi dan total biaya transportasi</li>
            <li>Menyediakan fitur ekspor hasil ke PDF dan CSV</li>
        </ul>
    </div>
</section>

---

<section id="fitur" style="background:#fff">
    <div class="container">
        <h2>🔧 Fitur Utama</h2>
        <div class="grid-cards">
            <div class="card">
                <h3>📊 Input Data</h3>
                <ul>
                    <li>Input Supply &amp; Demand</li>
                    <li>Matriks Biaya Transportasi</li>
                    <li>Validasi data (supply = demand)</li>
                </ul>
            </div>
            <div class="card">
                <h3>🧮 Perhitungan Otomatis</h3>
                <ul>
                    <li>Metode Northwest Corner</li>
                    <li>Tabel hasil alokasi</li>
                    <li>Total biaya transportasi</li>
                </ul>
            </div>
            <div class="card">
                <h3>💾 Ekspor Data</h3>
                <ul>
                    <li>Ekspor ke PDF</li>
                    <li>Ekspor ke CSV</li>
                    <li>Tombol reset data</li>
                </ul>
            </div>
        </div>
    </div>
</section>

---

<section id="teknologi">
    <div class="container">
        <h2>⚙️ Teknologi yang Digunakan</h2>
        <div align="center" class="badges"
            style="display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; margin: 30px 0;">
            <img alt="Laravel"
                src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
            <img alt="Livewire"
                src="https://img.shields.io/badge/Livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white">
            <img alt="MySQL"
                src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
            <img alt="HTML5"
                src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white">
            <img alt="CSS3"
                src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white">
            <img alt="JavaScript"
                src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">
        </div>
    </div>
</section>

---

<section id="tampilan" style="background:#fff">
    <div class="container">
        <h2>🖼 Tampilan Sistem</h2>
        <h3>Halaman Login</h3>
        <div class="gallery" style="margin-bottom:35px">
            <img src="./public/Test/Image/login.png" alt="Halaman Login">
        </div>
        <h3>Halaman Utama Transportasi</h3>
        <div class="gallery" style="margin-bottom:35px">
            <img src="./public/Test/Image/tampulan-utama.png" alt="Halaman Utama">
            <img src="./public/Test/Image/tambah-kasus.png" alt="Tambah Kasus">
        </div>
        <h3>Contoh Input &amp; Output</h3>
        <div class="gallery">
            <img src="./public/Test/Image/Input.png" alt="Contoh Input">
            <img src="./public/Test/Image/Output.png" alt="Contoh Output">
        </div>
        <h3 style="margin-top:35px">Panduan Sistem</h3>
        <div class="gallery">
            <img src="./public/Test/Image/panduan.png" alt="Panduan Sistem">
        </div>
    </div>
</section>

---

<section id="instalasi">
    <div class="container">
        <h2>🛠 Instalasi &amp; Menjalankan Proyek</h2>
        <pre style="background:#2d2d2d;color:#f1f1f1;padding:5px;border-radius:var(--radius);overflow-x:auto">

            
## Clone repositori
    git clone https://github.com/Andrew2509/PROGRAM-PENGHITUNG-TRANPORTASI-DENGAN-METODE-NORTWEST-CORNER.git
 
    cd PROGRAM-PENGHITUNG-TRANPORTASI-DENGAN-METODE-NORTWEST-CORNER 

## Install dependencies
    composer update

    composer install
 
    npm install && npm run dev

## Konfigurasi environment
    cp .env.example .env
    
    php artisan key:generate

## Setup database
    php artisan migrate --seed
    
## Jalankan server
    php artisan serve
    
</pre>
    <p class="lead">Akses <code>http://localhost:8000</code></p>
     <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>admin</td>
                    <td>12345678</td>
                </tr>
            </tbody>
        </table>
        </div>
</section>

---

<section id="kontributor" style="background:#fff">
    <div class="container">
        <h2>👨‍💻 Kontributor</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Peran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Princenton Andrew Brightly Masrikat</td>
                    <td>1462100248</td>
                    <td>Desain Input &amp; Tampilan</td>
                </tr>
                <tr>
                    <td>Nouval B. Saputra</td>
                    <td>1462100264</td>
                    <td>Logika Algoritma &amp; Output</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

---

## 📜 Lisensi
<p>
    Proyek ini dibuat untuk keperluan akademik (UAS Pengujian Perangkat Lunak) dan tidak dimaksudkan untuk digunakan di lingkungan produksi.
</p>

---

<p align="center">
    © 2025 Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner
</p>
