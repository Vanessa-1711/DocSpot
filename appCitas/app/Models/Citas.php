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

    protected $dates = ['fecha']; // Only 'fecha' is a full date

    // If you need a custom accessor for 'hora'
    public function getHoraAttribute($value)
    {
        // This is where you can format the time value if needed
        return $value;
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}
