<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama_instansi',
        'Kontak', // Jika memang di DB masih pakai 'Kontak', ini tetap.
        'status',
    ];

    // Relasi opsional ke Laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'instansi','id_instansi');
    }
}
