<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // <- defaultnya 'users', kamu pakai 'user'

    protected $primaryKey = 'id_user'; // jika kamu pakai 'id_user' bukan 'id'

    public $timestamps = false; // kalau tabelmu tidak pakai created_at, updated_at

    protected $fillable = [
        'username',
        'alamat',
        'jenis_kelamin',
        'no_telp',
        'email',
        'password',
        'status_user',
    ];
}
