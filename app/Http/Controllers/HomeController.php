<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruang;
use App\Models\PinjamRuang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $roles = $user->role;

        if($roles=="user"){
            // $ruang = Ruang::where('id', function ($query) {
            //             $query->select('id_ruang')
            //                 ->from('pinjamruang');
            //         })->get();
            $ruang = Ruang::all();
                    return view('landing', ['ruang' => $ruang]);
        }elseif($roles=="admin"){
            return redirect()->route('admin.home');

        }
        // $ruang = Ruang::whereNotIn('id', function ($query) {
        //     $query->select('id_ruang')
        //         ->from('pinjamruang')
        //         ->where('status', '!=', 'belum disetujui')
        //         ->orwhere('status', '!=', 'disetujui');
        // })->get();
        // return view('landing', ['ruang' => $ruang]);
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

    // YANG LAMANYA

    public function pinjam(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'tglmulai' => 'required|date',
                'tglselesai' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($request) {
                        $startDate = $request->input('tglmulai');
                        if (strtotime($value) < strtotime($startDate)) {
                            $fail('Tanggal selesai harus lebih dari tanggal mulai.');
                        }
                    }
            ],
            'nama' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => [
                'required',
                'date_format:H:i', // Format waktu (HH:mm)
                function ($attribute, $value, $fail) use ($request) {
                    $startTime = $request->input('waktumulai');
                    $endTime = $request->input('waktuselesai');
                    $startDate = $request->input('tglmulai');
                    $endDate = $request->input('tglselesai');
    
                    if (strtotime($endDate) == strtotime($startDate) && strtotime($value) <= strtotime($startTime)) {
                        $fail('Waktu selesai harus lebih besar dari waktu mulai.');
                    } elseif (strtotime($endDate) > strtotime($startDate) && strtotime($value) <= strtotime('00:00')) {
                        $fail('Waktu selesai harus lebih besar dari waktu mulai.');
                    } elseif (strtotime($endDate) == strtotime($startDate) && strtotime($value) <= strtotime($startTime)) {
                        $fail('Waktu selesai harus lebih besar dari waktu mulai.');
                    }
                },
            ],
            'pilihruang' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = $request->tglmulai;
                    $endDate = $request->tglselesai;
    
                    $existingBooking = PinjamRuang::where('id_ruang', $value)
                        ->where(function ($query) use ($startDate, $endDate) {
                            $query->where(function ($query) use ($startDate, $endDate) {
                                $query->where('tanggalmulai', '>=', $startDate)
                                    ->where('tanggalmulai', '<=', $endDate);
                            })
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('tanggalselesai', '>=', $startDate)
                                    ->where('tanggalselesai', '<=', $endDate);
                            })
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('tanggalmulai', '<=', $startDate)
                                    ->where('tanggalselesai', '>=', $endDate);
                            });
                        })
                        ->get();
    
                    if ($existingBooking) {
                        $fail('Ruang tersebut sudah dipinjam pada rentang tanggal yang sama oleh user lain.');
                    }
                }
            ],       
            'keperluan' => 'required',
            'tujuan' => 'required',
            'nohp' => 'required'

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
        
            if ($errors->has('tglselesai')) {
                return redirect()->back()->with('error', 'Gagal, Tanggal selesai harus lebih dari tanggal mulai.');
            } elseif ($errors->has('pilihruang')) {
                return redirect()->back()->with('error', 'Gagal, Ruang tersebut sudah dipinjam pada rentang tanggal yang sama oleh user lain.');
            }
        
            // Kode ini akan dijalankan jika validasi gagal tetapi tidak ada kesalahan spesifik yang ditangkap
            return redirect()->back()->with('error', 'Terjadi kesalahan validasi.');
        }
 
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
            'id_ruang' => $request->pilihruang,
            'status' => 'belum disetujui'
        ];

        PinjamRuang::create($pinjam);

        return redirect()->route('user.home')->with('success', 'Ruang berhasil dipinjam');

    }
    
}