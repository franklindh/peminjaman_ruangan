@extends('layouts.default')
@section('content')
    <style>
        .con {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="con">
        <div class="form-container">
            @if ($peminjaman->count() > 0)
                @foreach ($peminjaman as $p)
                    <p>Status Peminjaman: {{ $p->status }}</p>
                    <p>Ruangan yang Dipinjam: {{ $p->ruangan->nama_ruang }}</p>
                    <hr>
                @endforeach
                <form action="{{ route('user.batal') }}" method="POST">
                    @csrf
                    <input type="hidden" name="peminjaman_id" value="{{ $p->id }}">
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membatalkan peminjaman?')">Batal
                        Peminjaman</button>
                </form>
            @else
                <p>Anda belum meminjam ruangan.</p>
            @endif
        </div>
    </div>

@endsection
@section('scripts')
    <script src="js/cek.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
@endsection
