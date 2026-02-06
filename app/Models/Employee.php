<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'position', 'phone', 'tags', 'status', 'user_id'
    ];

    // Buscador Inteligente por Nombre, Email o Etiquetas
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($q) use ($term) {
            $q->where('full_name', 'like', $term)
              ->orWhere('email', 'like', $term)
              ->orWhere('tags', 'like', $term);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}