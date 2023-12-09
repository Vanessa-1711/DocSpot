<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\Hospital;
use App\Models\PacienteHospital;
use App\Models\Paciente;
use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    public function index()
    {
        $medicoId = Auth::user()->medico->id;

        $citas = Citas::with('paciente')->where('medico_id', $medicoId)->get();
        $totalCitas = Citas::where('medico_id', $medicoId)->count();
        $citasPendientes = Citas::where('medico_id', $medicoId)
                               ->where('fecha', '>', now())
                               ->count();
        $citasConfirmadas = Citas::where('medico_id', $medicoId)
                                ->where('estado', 1)
                                ->count();

        return view('medico.dashboard', [
            'citas' => $citas,
            'totalCitas' => $totalCitas,
            'citasPendientes' => $citasPendientes,
            'citasConfirmadas' => $citasConfirmadas,
        ]);
    }
}
