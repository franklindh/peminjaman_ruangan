@extends('layouts.default')
@section('content')
    <div class="" style="display: flex; justify-content: center; text-align: center; padding-top:24px;">
        <h1>Keperluan Peminjaman Ruangan</h1>
    </div>
    <div class="" style="display: flex; justify-content: center; text-align: center">
        {{-- <h1 style="text-align: center;">Pinjam Ruang</h1> --}}
        <div class="form-container-index" style="padding: 24px;">
            <a href="{{ route('kuliah.view') }}">
                <div class="card" style="width: 18rem; margin-right: 24px;">
                    <div class="card-body">
                        <h2>Kuliah</h2>
                    </div>
                </div>
            </a>
            <a href="{{ route('seminar.view') }}">
                <div class="card" style="width: 18rem; margin-right: 24px;">
                    <div class="card-body">
                        <h2>Seminar</h2>
                    </div>
                </div>
            </a>
            <a href="{{ route('pameran.view') }}">
                <div class="card" style="width: 18rem; margin-right: 24px;">
                    <div class="card-body">
                        <h2>Pameran</h2>
                    </div>
                </div>
            </a>


        </div>
    </div>
@endsection
@section('scripts')
    <script src="js/landing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection
