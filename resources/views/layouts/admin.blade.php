<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Tambahkan link CSS dan script JS yang diperlukan -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Tambahkan navigasi atau menu admin di sini -->
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Peminjam Ruang</a></li>
            <li><a href="#">Ruangan</a></li>
            <!-- Tambahkan menu lainnya sesuai kebutuhan -->
        </ul>
    </nav>

    <main>
        @yield('content') <!-- Bagian konten utama dari halaman -->
    </main>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Tambahkan script JS yang diperlukan -->
</body>
</html>
