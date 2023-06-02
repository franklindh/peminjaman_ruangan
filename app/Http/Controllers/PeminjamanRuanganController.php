<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        // Tampilkan halaman validasi peminjaman ruangan
        return view('admin.validasi');
    }

    public function validasi(Request $request)
    {
        // Lakukan validasi peminjaman ruangan di sini
        // Proses data yang dikirim melalui $request
        // ...

        // Redirect kembali ke halaman validasi dengan pesan sukses atau error
        return redirect()->route('admin.validasi')->with('status', 'Peminjaman ruangan telah divalidasi.');
    }

    public function validasiPeminjaman($id)
    {
        // Menemukan data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::find($id);

        // Lakukan validasi peminjaman di sini

        // Misalnya, tambahkan kolom 'status' ke tabel 'peminjaman' dan set nilainya menjadi 'Valid'
        $peminjaman->status = 'Valid';
        $peminjaman->save();

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Peminjaman berhasil divalidasi.');
    }
}
