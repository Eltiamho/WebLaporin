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

    protected $fillable = [
        'nama_instansi',
        'Kontak',
        'status',
    ];
}
