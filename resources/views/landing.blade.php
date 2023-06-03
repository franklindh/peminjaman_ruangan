@extends('layouts.default')
@section('content')
    <div class="container" style="">
        <div class="form-container">
            <form method="POST" action={{ route('pinjam') }}>
                @csrf
                <h2>Formulir Peminjaman Ruangan</h2>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="nohp">Nomor Hp/Whatsapp:</label>
                    <input type="text" inputmode="numeric" pattern="[0-9]*" id="nohp" name="nohp" required>
                </div>
                <div class="form-group">
                    <label for="tglmulai">Tanggal Mulai:</label>
                    <input type="date" id="tglmulai" name="tglmulai" required>
                </div>
                <div class="form-group">
                    <label for="tglselesai">Tanggal Selesai:</label>
                    <input type="date" id="tglselesai" name="tglselesai" required>
                </div>
                <div class="form-group">
                    <label for="waktumulai">Waktu Mulai:</label>
                    <input type="time" id="waktumulai" name="waktumulai" required>
                </div>
                <div class="form-group">
                    <label for="waktuselesai">Waktu Selesai:</label>
                    <input type="time" id="waktuselesai" name="waktuselesai" required>
                </div>
                <div class="form-group">
                    <label for="pilihruang">Ruang:</label>
                    <select name="pilihruang" id="pilihruang">
                        <option value="" disabled selected>Pilih Ruang</option>
                        @foreach ($ruang as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keperluan">Keperluan</label>
                    <select name="keperluan" id="keperluan">
                        <option value="" disabled selected>Pilih Keperluan</option>
                        <option value="Akademik">Akademik</option>
                        <option value="Seminar">Seminar</option>
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
@endsection
