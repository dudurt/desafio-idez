<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class County extends Authenticatable
{
    use HasApiTokens, HasFactory;

    public static $expirationTime = "Padrão Estoque";

    protected $fillable = [
        'name',
        'ibge_code',
    ];

    protected $hidden = [
        'updated_at' => 'datetime',
    ];
}
