<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'estado',
        'medico_id',
        'paciente_id',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}
