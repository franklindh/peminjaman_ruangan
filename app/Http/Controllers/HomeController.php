<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruang;
use App\Models\PinjamRuang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $ruang = Ruang::whereNotIn('id', function ($query) {
            $query->select('id_ruang')
                ->from('pinjamruang')
                ->where('status', '!=', 'dibatalkan');
        })->get();
        return view('landing', ['ruang' => $ruang]);
    }

    public function ruang()
    {
        $ruang = Ruang::all();
        return view('ruang', ['ruang' => $ruang]);
    }
    public function cek()
    {
        $user = Auth::user();
        $userid = $user->id;
        $peminjaman = PinjamRuang::with('ruangan')->where('id_user', $userid)->get();

        return view('cek')->with('peminjaman', $peminjaman);

    }

    public function batal(Request $request)
    {
        $peminjamanId = $request->peminjaman_id;

        $peminjaman = PinjamRuang::findOrFail($peminjamanId);

        // Lakukan pengecekan otorisasi di sini (jika diperlukan)

        $peminjaman->delete();

        // Tambahkan logika lain yang diperlukan setelah pembatalan peminjaman

        return redirect()->back()->with('status', 'Peminjaman berhasil dibatalkan.');

    }

    public function kontak()
    {
        return view('kontak');
    }

    public function pinjam(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => 'required',
            'pilihruang' => 'required',
            'keperluan' => 'required',
            'tujuan' => 'required',
            'nohp' => 'required'
        ]);

        $user = Auth::user();

        $pinjam = [
            'nama' => $request->nama,
            'tanggalmulai' => $request->tglmulai,
            'tanggalselesai' => $request->tglselesai,
            'waktumulai' => $request->waktumulai,
            'waktuselesai' => $request->waktuselesai,
            'keperluan' => $request->keperluan,
            'tujuan' => $request->tujuan,
            'email' => $user->email,
            'nohp' => $request->nohp,
            'id_user' => $user->id,
            'id_ruang' => $request->pilihruang
        ];

        PinjamRuang::create($pinjam);

        return redirect()->route('user.home')->with('success', 'Ruang berhasil dipinjam');

    }
}