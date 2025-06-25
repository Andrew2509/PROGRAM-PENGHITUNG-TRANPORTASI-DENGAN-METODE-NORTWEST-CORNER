<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Transportation Northwest Corner' }}</title>
        <link rel="stylesheet" href="{{ asset('Test/css/style.css') }}">

        @livewireStyles
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
    </body>
</html>
<script src="{{ asset('Test/JS/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script>
    // Demo interactivity
    document.addEventListener("DOMContentLoaded", function () {
    // Pastikan elemen telah dimuat sebelum menambahkan event
    const addRowButtons = document.querySelectorAll('button[wire\\:click="addRow"]');
    addRowButtons.forEach((button, index) => {
        button.addEventListener('click', () => addRow(index));
    });

    const addColumnButtons = document.querySelectorAll('button[wire\\:click="addColumn"]');
    addColumnButtons.forEach((button, index) => {
        button.addEventListener('click', () => addColumn(index));
    });
});

document.addEventListener('livewire:load', function () {
        // Menangani event dari Livewire untuk download gambar
        window.addEventListener('downloadImage', event => {
            const table = document.getElementById('allocation-table'); // Ambil elemen tabel yang ingin di-capture

            // Menggunakan html2canvas untuk menangkap screenshot dari tabel
            html2canvas(table).then(canvas => {
                // Membuat URL untuk gambar
                const imgURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imgURL;
                link.download = 'hasil_alokasi.png';  // Nama file gambar
                link.click(); // Memulai proses download
            });
        });
    });
</script>
