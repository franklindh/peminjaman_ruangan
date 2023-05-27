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
        $ruang = Ruang::all();
        return view('landing', ['ruang' => $ruang]);
    }
    public function ruang()
    {
        $ruang = Ruang::all();
        return view('ruang', ['ruang' => $ruang]);
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
            'pilihruang' => 'required',
            'keperluan' => 'required',
            'nohp' => 'required'
        ]);

        $user = Auth::user();

        $pinjam = [
            'nama' => $request->nama,
            'tanggalmulai' => $request->tglmulai,
            'tanggalselesai' => $request->tglselesai,
            'keperluan' => $request->keperluan,
            'email' => $user->email,
            'nohp' => $request->nohp,
            'id_user' => $user->id,
            'id_ruang' => $request->pilihruang
        ];

        PinjamRuang::create($pinjam);

        return redirect()->route('user.home')->with('success', 'Ruang berhasil dipinjam');

    }
}