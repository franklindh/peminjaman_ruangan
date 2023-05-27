<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamRuang extends Model
{
    use HasFactory;
    protected $guard = 'pinjamruang';
    protected $table = 'pinjamruang';
    protected $fillable = [
        'nama',
        'tanggalmulai',
        'tanggalselesai',
        'keperluan',
        'email',
        'nohp',
        'id_user',
        'id_ruang'
    ];
}