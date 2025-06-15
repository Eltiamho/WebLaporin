<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    public $timestamps = false; // tambahkan ini
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
         'id_laporan',
        'nama',
        'email',
        'jumlah',
        'pesan',
        'tanggal',
    ];
}
