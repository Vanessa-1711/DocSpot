<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteHospital extends Model
{
    use HasFactory;
    protected $table = 'pacientes_hospitales';

    protected $fillable = [
        'curp',
        'nss',
        'hospital_id',
        'paciente_id',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

}
