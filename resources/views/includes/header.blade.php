<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Pinjam Ruang <span>UKDW</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if (\Request::is('/')) active @endif"><a href="/"
                        class="nav-link">Beranda</a></li>
                {{-- <li class="nav-item"><a href="about.html" class="nav-link">Tentang</a></li> --}}
                <li class="nav-item"><a href="{{ route('user.cek') }}" class="nav-link">Status Peminjaman</a></li>
                <li class="nav-item"><a href="{{ route('user.ruang') }}" class="nav-link">Ruang</a></li>
                {{-- <li class="nav-item @if (\Request::is('rooms')) active @endif"><a href="{{ route('rooms') }}"
                        class="nav-link">Daftar Ruangan</a></li> --}}
                <li class="nav-item"><a href="{{ route('user.kontak') }}" class="nav-link">Kontak</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
