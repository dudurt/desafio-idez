<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class City extends Authenticatable
{
    use HasApiTokens, HasFactory;

    public $expirationTime = 60;

    protected $fillable = [
        'name',
        'ibge_code',
    ];

    protected $hidden = [
        'updated_at' => 'datetime',
    ];
}
