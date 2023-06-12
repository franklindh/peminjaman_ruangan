<?php

namespace App\Http\Controllers;

use App\Models\PinjamRuang;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function dashboard_admin()
    {
        return view('dashboard');
    }

    public function index()
    {
        $belumDisetujuiCount = PinjamRuang::where('status', 'belum disetujui')->count();
        $sudahDisetujuiCount = PinjamRuang::where('status', 'disetujui')->count();
        $ditolakCount = PinjamRuang::where('status', 'ditolak')->count();
        $dselesaiCount = PinjamRuang::where('status', 'delesai')->count();
        // $totalPeminjamanCount = PinjamRuang::count();

        return view('admin.setup', [
            'users' => PinjamRuang::orderBy('id', 'desc')->get(),
            'belumDisetujuiCount' => $belumDisetujuiCount,
            'sudahDisetujuiCount' => $sudahDisetujuiCount,
            'ditolakCount' => $ditolakCount,
            'dselesaiCount' => $dselesaiCount,
        ]);

        // return view('admin.setup', [
        //     'users' => PinjamRuang::where('status', 'belum disetujui')
        //         ->orWhere('status', 'sudah disetujui')
        //         ->orderBy('id', 'desc')
        //         ->get()
        // ]);


    }
}