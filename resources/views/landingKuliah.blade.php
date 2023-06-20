@extends('layouts.default')
@section('content')
    <div class="container" style="">
        <div class="form-container">
            {{-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pinjam.kuliah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nohp">Nomor Hp/Whatsapp:</label>
                    <input type="text" inputmode="numeric" pattern="[0-9]*" id="nohp" name="nohp" required>
                </div>
                <div class="form-group">
                    <label for="hari">Hari Peminjaman:</label>
                    <select name="hari[]" id="hari" class="form-control" required>
                        <!-- Menampilkan pilihan hari -->
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <!-- tambahkan opsi hari lainnya -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="waktumulai">Waktu Mulai:</label>
                    <!-- <input type="time" id="waktumulai" name="waktumulai" required> -->
                    <input type="text" name="waktumulai" class="timepicker" placeholder="JJ:MM">
                </div>
                <div class="form-group">
                    <label for="waktuselesai">Waktu Selesai:</label>
                    <!-- <input type="time" id="waktuselesai" name="waktuselesai" required> -->
                    <input type="text" name="waktuselesai" class="timepicker" placeholder="JJ::MM">
                </div>

                <div class="form-group">
                    <label for="ruang_id">Ruang:</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" required>
                        <!-- Menampilkan pilihan ruang dari database -->
                        @foreach ($ruang as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="tombolform">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="form-container">
            <h2>Aturan Peminjaman Ruangan</h2>
            Aturan Peminjaman Ruangan Akademik:<br>
            1. Tujuan Peminjaman
            <ul>
                <li>Ruangan dapat dipinjam untuk kegiatan akademik seperti kuliah, seminar, diskusi, atau pertemuan
                    kelompok studi.</li>
                <li>Kegiatan non-akademik tidak diizinkan kecuali ada persetujuan khusus.</li>
            </ul>

            2. Proses Peminjaman
            <ul>
                <li>Peminjaman ruangan akademik harus diajukan melalui sistem pemesanan yang tersedia di website kampus.
                </li>
                <li>Pengajuan peminjaman harus mematuhi jadwal peminjaman yang telah ditentukan.</li>
                <li>Pihak yang mengajukan peminjaman harus memberikan informasi lengkap mengenai kegiatan yang akan
                    dilakukan.</li>
            </ul>

            3. Verifikasi Peminjaman
            <ul>
                <li>Pihak yang bertanggung jawab akan memeriksa ketersediaan ruangan dan kecocokan kegiatan dengan jadwal
                    yang ada.
                </li>
                <li>Konfirmasi peminjaman akan dikirimkan melalui email atau notifikasi pada sistem pemesanan.</li>
                <li>Jika terdapat konflik jadwal, peminjam akan diminta untuk memilih jadwal alternatif jika tersedia.</li>
            </ul>
            4. Persyaratan Peminjaman
            <ul>
                <li>Peminjam harus menyediakan informasi lengkap mengenai kegiatan, jumlah peserta, dan kebutuhan teknis
                    (jika ada).
                </li>
                <li>Peminjam bertanggung jawab untuk menjaga kebersihan ruangan dan peralatan yang digunakan.</li>
                <li>Peminjam harus mematuhi peraturan kampus terkait penggunaan ruangan akademik.</li>
            </ul>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="js/landing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('.timepicker', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: {
                firstDayOfWeek: 1, // Mengatur hari pertama dalam seminggu menjadi Senin
            },
        });
    </script>
@endsection
