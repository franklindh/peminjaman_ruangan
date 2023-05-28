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
        return redirect()->route('admin.validasidetail')->with('status', 'Peminjaman ruangan telah divalidasi.');
    }
}
