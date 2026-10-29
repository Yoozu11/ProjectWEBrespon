<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswas';
    protected $fillable = ['nama', 'nim', 'email'];
    protected $hidden = ['password'];
}
