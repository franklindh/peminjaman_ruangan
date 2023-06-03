<?php

namespace App\Models;

use App\Models\Ruang;
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
        'waktumulai',
        'waktuselesai',
        'keperluan',
        'tujuan',
        'email',
        'nohp',
        'status',
        'id_user',
        'id_ruang'
    ];
    public function ruangan()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }

}