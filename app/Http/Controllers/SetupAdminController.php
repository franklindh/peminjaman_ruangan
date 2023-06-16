<?php

namespace App\Http\Controllers;
use App\Models\Ruang;
use Illuminate\Http\Request;


class SetupAdminController extends Controller
{
    public function setup()
    {
        return view('admin.setupadmin');
    }

    public function tambahruang(Request $request)
    {
        $validatedData = $request->validate([
            'kapasitas' => 'required',
            'nama_ruang' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            'fasilitas' => 'required',
        ]);

        $gambarPath = $request->file('gambar')->store('public/gambar');
        $gambarUrl = asset('storage/' . str_replace('public/', '', $gambarPath));

        $tambahruang = [
            'kapasitas' => $request->kapasitas,
            'nama_ruang' => $request->nama_ruang,
            'gambar' => $gambarUrl,
            'kategori' => $request->kategori,
            'fasilitas' => $request->fasilitas
        ];

        Ruang::create($tambahruang);

        
        return view('admin.setupadmin')->with('success', 'Ruangan berhasil ditambahkan.');
        // return redirect()->route('setupadmin.tambahruang')->with('success', 'Ruangan berhasil ditambahkan.');
    }

}
