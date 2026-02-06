<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Esto permite guardar datos en masa en estas columnas
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'status',
        'user_id',
    ];
}
