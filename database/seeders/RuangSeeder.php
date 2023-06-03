<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruang;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataruang = [
            [
                'kapasitas' => '100',
                'nama_ruang' => 'Ruang B.3.4',
                'gambar' => 'b34',
                'kategori' => 'Ruang Kelas',
                'fasilitas' => 'Meja, Proyektor, Kursi'
            ],
            [
                'kapasitas' => '250',
                'nama_ruang' => 'Ruang Seminar Didaktos',
                'gambar' => 'didaktos',
                'kategori' => 'Ruang Seminar',
                'fasilitas' => 'Meja, Proyektor, Kursi'
            ],
            [
                'kapasitas' => '150',
                'nama_ruang' => 'Ruang Seminar Pdt. Dr. Harun Hadiwijono',
                'gambar' => 'rudi',
                'kategori' => 'Ruang Seminar',
                'fasilitas' => 'Meja, Proyektor, Kursi'
            ]
        ];
        Ruang::insert($dataruang);

    }
}