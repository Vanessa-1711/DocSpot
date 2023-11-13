<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'tipo',
        'user_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

}
