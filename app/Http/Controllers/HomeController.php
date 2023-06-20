<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruang;
use App\Models\PinjamRuang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $roles = $user->role;

        if ($roles == "user") {
            $ruang = Ruang::all();
            return view('index', ['ruang' => $ruang]);
        } elseif ($roles == "admin") {
            return redirect()->route('admin.home');
        }
    }
    public function homeKuliah()
    {
        $ruang = Ruang::all();
        return view('landingKuliah', ['ruang' => $ruang]);
    }
    public function homeSeminar()
    {
        $ruang = Ruang::all();
        return view('landingSeminar', ['ruang' => $ruang]);
    }
    public function homePameran()
    {
        $ruang = Ruang::all();
        return view('landingPameran', ['ruang' => $ruang]);
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

    public function pinjamKuliah(Request $request)
    {
        $request->validate([
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => 'required',
            'keperluan' => 'required',
            'tujuan' => 'required',
            'nohp' => 'required',
            'ruang' => 'required',
        ]);

        $user = Auth::user();

        $pinjam = [
            'nama' => $user->name,
            'tanggalmulai' => $request->tglmulai,
            'tanggalselesai' => $request->tglselesai,
            'waktumulai' => $request->waktumulai,
            'waktuselesai' => $request->waktuselesai,
            'keperluan' => $request->keperluan,
            'tujuan' => $request->tujuan,
            'email' => $user->email,
            'nohp' => $request->nohp,
            'id_user' => $user->id,
            'id_ruang' => $request->ruang,
            'status' => 'belum disetujui'
        ];

        PinjamRuang::create($pinjam);

        return redirect()->route('user.home')->with('success', 'Ruang berhasil dipinjam');

    }
    public function pinjamSeminar(Request $request)
    {
        $request->validate([
            'tglmulai' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => 'required',
            'tujuan' => 'required',
            'nohp' => 'required',
            'ruang' => 'required',
        ]);

        $user = Auth::user();

        $previousBooking = PinjamRuang::where('id_user', $user->id)
            ->where('tanggalmulai', $request->tglmulai)
            ->latest()
            ->first();

        if ($previousBooking) {
            $selesaiSebelumnya = Carbon::parse($previousBooking->tanggalselesai . ' ' . $previousBooking->waktuselesai);
            $mulaiSekarang = Carbon::parse($request->tglmulai . ' ' . $request->waktumulai);
            $minimumTimeGap = $selesaiSebelumnya->addHour(); // Menambahkan 1 jam ke waktu selesai sebelumnya

            if ($mulaiSekarang->lt($minimumTimeGap)) {
                return redirect()->back()->with('error', 'Anda harus menunggu minimal 1 jam setelah peminjaman sebelumnya selesai.');
            }
        }

        $pinjam = [
            'nama' => $user->name,
            'tanggalmulai' => $request->tglmulai,
            'tanggalselesai' => $request->tglmulai,
            'waktumulai' => $request->waktumulai,
            'waktuselesai' => $request->waktuselesai,
            'keperluan' => 'Seminar',
            'tujuan' => $request->tujuan,
            'email' => $user->email,
            'nohp' => $request->nohp,
            'id_user' => $user->id,
            'id_ruang' => $request->ruang,
            'status' => 'belum disetujui'
        ];

        PinjamRuang::create($pinjam);

        return redirect()->back()->with('success', 'Peminjaman ruang untuk pameran berhasil dilakukan.');
    }
    public function pinjamPameran(Request $request)
    {
        $request->validate([
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => 'required',
            'tujuan' => 'required',
            'nohp' => 'required',
            'ruang' => 'required',
        ]);

        $user = Auth::user();

        $previousBooking = PinjamRuang::where('id_user', $user->id)
            ->where('tanggalmulai', $request->tglmulai)
            ->latest()
            ->first();

        if ($previousBooking) {
            $selesaiSebelumnya = Carbon::parse($previousBooking->tanggalselesai . ' ' . $previousBooking->waktuselesai);
            $mulaiSekarang = Carbon::parse($request->tglmulai . ' ' . $request->waktumulai);
            $minimumTimeGap = $selesaiSebelumnya->addHour(); // Menambahkan 1 jam ke waktu selesai sebelumnya

            if ($mulaiSekarang->lt($minimumTimeGap)) {
                return redirect()->back()->with('error', 'Anda harus menunggu minimal 1 jam setelah peminjaman sebelumnya selesai.');
            }
        }

        $pinjam = [
            'nama' => $user->name,
            'tanggalmulai' => $request->tglmulai,
            'tanggalselesai' => $request->tglselesai,
            'waktumulai' => $request->waktumulai,
            'waktuselesai' => $request->waktuselesai,
            'keperluan' => 'Pameran',
            'tujuan' => $request->tujuan,
            'email' => $user->email,
            'nohp' => $request->nohp,
            'id_user' => $user->id,
            'id_ruang' => $request->ruang,
            'status' => 'belum disetujui'
        ];

        PinjamRuang::create($pinjam);

        return redirect()->back()->with('success', 'Peminjaman ruang untuk pameran berhasil dilakukan.');
    }




}