<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Transportation Northwest Corner' }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('Test/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('Test/css/bantuan.css') }}">
        <link rel="stylesheet" href="{{ asset('Test/css/login.css') }}">


        @livewireStyles
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
    </body>

    <script src="{{ asset('Test/JS/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


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
    </script>
</html>


