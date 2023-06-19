@extends('layouts.default')
@section('content')
    <div class="container1" style="">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Ruang</th>
                    <th>Gambar</th>
                    <th>Kapasitas</th>
                    <th>Fasilitas</th>
                    <th>Kategori</th>
                    <!-- Kolom lainnya -->
                </tr>
            </thead>
            <tbody>
                @foreach ($ruang as $r)
                    <tr>
                        <td style="width: 25%;">
                            <span><b>{{ $r->nama_ruang }}</b></span>
                        </td>
                        <td>
                            <img src="{{ asset($r->gambar) }}" alt="Gambar Kecil" style="width: 300px; height: 200px">
                        </td>
                        <td>{{ $r->kapasitas }}</td>
                        <td>{{ $r->fasilitas }}</td>
                        <td>{{ $r->kategori }}</td>
                        <!-- Kolom lainnya -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div>
        </div> --}}
    </div>
    <script src="{{ asset('js/landing.js') }}"></script>
@endsection
