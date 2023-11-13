<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'latitud',
        'longitud',
        'fecha_nacimiento',
        'hospital_id',
        'user_id',
    ];

    public function hospital()
    {
        return $this->hasMany(Hospital::class, 'hospital_id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'rol_id');
    }
}
