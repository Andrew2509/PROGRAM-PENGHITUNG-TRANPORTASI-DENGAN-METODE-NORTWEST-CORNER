<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Sistem Penghitungan Biaya Transportasi – Northwest Corner</title>

  <!-- ====== GOOGLE FONTS (opsional, tetapi membuat tampilan lebih modern) ====== -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- ====== STYLE ====== -->
  <style>
    :root {
      --warna-primer: #FF2D20;     /* Laravel Red untuk aksen */
      --bg-latar:     #f8f9fa;
      --bg-kartu:     #ffffff;
      --teks-gelap:   #212529;
      --teks-abu:     #6c757d;
      --bayangan:     0 4px 8px rgba(0,0,0,.05);
      --radius:       12px;
      --max-content:  1150px;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{
      font-family:"Inter",sans-serif;
      line-height:1.6;
      background:var(--bg-latar);
      color:var(--teks-gelap);
    }
    /* ---------- Header & Nav ---------- */
    header{
      background:var(--bg-kartu);
      box-shadow:var(--bayangan);
      position:sticky;top:0;z-index:100;
    }
    .nav-container{
      max-width:var(--max-content);margin:auto;
      display:flex;align-items:center;justify-content:space-between;
      padding:12px 20px;
    }
    .logo{
      display:flex;align-items:center;gap:10px;
      font-weight:700;font-size:1.1rem;color:var(--teks-gelap);text-decoration:none;
    }
    nav a{
      margin-left:18px;
      text-decoration:none;
      color:var(--teks-abu);
      font-weight:600;
      transition:.2s;
    }
    nav a:hover,nav a:focus{
      color:var(--warna-primer);
    }
    /* ---------- Layout Helpers ---------- */
    section{
      padding:60px 20px;
    }
    .container{
      max-width:var(--max-content);
      margin:auto;
    }
    h2{
      margin-bottom:20px;
      font-size:1.75rem;
      color:var(--warna-primer);
    }
    p.lead{font-size:1.1rem;margin-bottom:25px}

    /* ---------- Grid Cards ---------- */
    .grid-cards{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
      gap:24px;
    }
    .card{
      background:var(--bg-kartu);
      border-radius:var(--radius);
      padding:24px;
      box-shadow:var(--bayangan);
    }
    .card h3{margin-bottom:10px;font-size:1.1rem}
    .card ul{list-style:disc;padding-left:20px}
    .card ul li{margin-bottom:6px}

    /* ---------- Tech Badges ---------- */
    .badges{
      display:flex;flex-wrap:wrap;gap:10px;margin-top:10px;
    }
    .badges img{height:36px}

    /* ---------- Gallery ---------- */
    .gallery{
      display:grid;
      gap:20px;
      grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    }
    .gallery img{
      width:100%;
      border-radius:var(--radius);
      box-shadow:var(--bayangan);
    }

    /* ---------- Table ---------- */
    table{
      width:100%;
      border-collapse:collapse;
      margin-top:20px;
      background:var(--bg-kartu);
      box-shadow:var(--bayangan);
      border-radius:var(--radius);
      overflow:hidden;
    }
    th,td{
      padding:12px 16px;
      border-bottom:1px solid #dee2e6;
      text-align:left;
    }
    th{background:#e9ecef;font-weight:600}

    /* ---------- Footer ---------- */
    footer{
      text-align:center;
      padding:24px 0;
      font-size:.9rem;
      color:var(--teks-abu);
    }

    /* ---------- Responsif Nav (optional hamburger) ---------- */
    @media(max-width:680px){
      nav{display:none}
    }
  </style>
</head>
<body>

  <!-- ====== HEADER ====== -->
  <header>
    <div class="nav-container">
      <a href="#" class="logo">
        <img src="./public/Test/Image/logo.png" alt="Logo Sistem" height="40">
        Sistem Transportasi
      </a>
      <nav>
        <a href="#tujuan">Tujuan</a>
        <a href="#fitur">Fitur</a>
        <a href="#teknologi">Teknologi</a>
        <a href="#tampilan">Tampilan</a>
        <a href="#instalasi">Instalasi</a>
        <a href="#kontributor">Kontributor</a>
      </nav>
    </div>
  </header>

  <!-- ====== HERO ====== -->
  <section style="text-align:center;padding-top:90px;padding-bottom:90px;background:#ffffff">
    <div class="container">
      <img src="./public/Test/Image/logo.png" alt="Logo Sistem" height="120" style="margin-bottom:24px">
      <h1 style="font-size:2.5rem;margin-bottom:16px">
        Sistem Penghitungan Biaya Transportasi<br>Metode Northwest Corner
      </h1>
      <p class="lead">Solusi efisien untuk alokasi distribusi barang &amp; total biaya transportasi.</p>
      <a href="#instalasi" style="display:inline-block;background:var(--warna-primer);color:#fff;padding:12px 28px;border-radius:8px;font-weight:600;text-decoration:none">Mulai Install</a>
    </div>
  </section>

  <!-- ====== TUJUAN ====== -->
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

  <!-- ====== FITUR ====== -->
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

  <!-- ====== TEKNOLOGI ====== -->
  <section id="teknologi">
    <div class="container">
      <h2>⚙️ Teknologi yang Digunakan</h2>
      <div class="badges">
        <img alt="Laravel"     src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
        <img alt="Livewire"    src="https://img.shields.io/badge/Livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white">
        <img alt="MySQL"       src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
        <img alt="HTML5"       src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white">
        <img alt="CSS3"        src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white">
        <img alt="JavaScript"  src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">
      </div>
    </div>
  </section>

  <!-- ====== TAMPILAN ====== -->
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
        <img src="./public/Test/Image/tambah-kasus.png"   alt="Tambah Kasus">
      </div>

      <h3>Contoh Input &amp; Output</h3>
      <div class="gallery">
        <img src="./public/Test/Image/Input.png"  alt="Contoh Input">
        <img src="./public/Test/Image/Output.png" alt="Contoh Output">
      </div>

      <h3 style="margin-top:35px">Panduan Sistem</h3>
      <div class="gallery">
        <img src="./public/Test/Image/panduan.png" alt="Panduan Sistem">
      </div>
    </div>
  </section>

  <!-- ====== INSTALASI ====== -->
  <section id="instalasi">
    <div class="container">
      <h2>🛠 Instalasi &amp; Menjalankan Proyek</h2>
      <pre style="background:#2d2d2d;color:#f1f1f1;padding:20px;border-radius:var(--radius);overflow-x:auto"><code># Clone repositori
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
</code></pre>

      <p class="lead">Akses <code>http://localhost:8000</code> &nbsp;|&nbsp; Login admin: <strong>admin</strong> / <strong>12345678</strong></p>
    </div>
  </section>

  <!-- ====== KONTRIBUTOR ====== -->
  <section id="kontributor" style="background:#fff">
    <div class="container">
      <h2>👨‍💻 Kontributor</h2>
      <table>
        <thead>
          <tr><th>Nama</th><th>NIM</th><th>Peran</th></tr>
        </thead>
        <tbody>
          <tr><td>Princenton Andrew Brightly Masrikat</td><td>1462100248</td><td>Desain Input &amp; Tampilan</td></tr>
          <tr><td>Nouval B. Saputra</td><td>1462100264</td><td>Logika Algoritma &amp; Output</td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ====== FOOTER ====== -->
  <footer>
    © 2023 Sistem Penghitungan Biaya Transportasi – Metode Northwest Corner
  </footer>

</body>
</html>
