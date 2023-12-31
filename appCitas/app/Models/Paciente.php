<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'num_seguro',
        'preferente',
        'fecha_nacimiento',
        'curp',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function citas()
    {
        return $this->hasMany(Citas::class, 'paciente_id');
    }
    
    public function pacienteHospital()
    {
        return $this->hasOne(PacienteHospital::class, 'paciente_id');
    }
}
