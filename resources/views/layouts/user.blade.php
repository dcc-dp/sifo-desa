<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi & Pengaduan Desa')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- File CSS kamu --}}
    <link rel="stylesheet" href="{{ asset('assets/css/user/style.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('layouts.user_header')

    {{-- Konten Halaman --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.user_footer')

    {{-- Script --}}
    <script src="{{ asset('assets/js/user/scripts.js') }}"></script>
</body>
</html>
