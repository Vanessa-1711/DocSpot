<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'dia',
        'medico_id',
    ];
    public function medico()
    {
        return $this->hasOne(Medico::class);
    }
}
