<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $guard = 'ruang';
    protected $table = 'ruang';
    protected $fillable = [
        'nama_ruang',
        'kapasitas',
        'kategori',
        'fasilitas',
        'status',
    ];
}