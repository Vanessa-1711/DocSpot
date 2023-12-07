<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Hospital;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DateTime;

class PacienteController extends Controller
{   
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {

        $pacienteId = auth()->user()->id;
        $pacienteId = Paciente::where('user_id', $pacienteId)->value('id');

        // Calcular cantidades para las tarjetas
        $confirmadasPorRealizar = Citas::where('paciente_id', $pacienteId)
                                       ->where('estado', 1)
                                       ->where('fecha', '>', now())
                                       ->count();
        $noConfirmadas = Citas::where('paciente_id', $pacienteId)
                              ->where('estado', 0)
                              ->count();
        $citasAtrasadas = Citas::where('paciente_id', $pacienteId)
                               ->where('fecha', '<', now())
                               ->where('estado', 0)
                               ->count();

        $citas = Citas::with('medico')
                      ->where('paciente_id', $pacienteId)
                      ->orderBy('fecha', 'asc')
                      ->orderBy('hora', 'asc')
                      ->get();

        return view('pacientes.dashboard', [
            'confirmadasPorRealizar' => $confirmadasPorRealizar,
            'noConfirmadas' => $noConfirmadas,
            'citasAtrasadas' => $citasAtrasadas,
            'citas' => $citas
        ]);
    }

    public function verMasHospital($id)
    {
        // Utiliza el parámetro $id para obtener la información del hospital
        $hospital = Hospital::find($id);
        // Recupera los médicos asociados a este hospital
        $medicos = Medico::where('hospital_id', $id)->get();
        // Pasa tanto la información del hospital como la lista de médicos a tu vista
        return view('pacientes.verMasHospital', [
            'hospital' => $hospital,
            'medicos' => $medicos,
        ]);
    }

    public function verMasDoc($id)
    {

        $medico = Medico::find($id);
        $horarios = Horario::where('medico_id', $medico->id)->get();
        return view('pacientes.verMasDoctor', [
            'medico' => $medico,
            'horarios' => $horarios,
        ]);
    }

    public function hospitales()
    {
        $cantidadHospitales = Hospital::count();
        $nombresHospitales = Hospital::all();
        $pacientes = Paciente::all();
        return view('pacientes.pacientesHos', ['pacientes' => $pacientes, 
        'cantidadHospitales' => $cantidadHospitales,
        'nombresHospitales' => $nombresHospitales,] );
    }

    public function citasPaciente($pacienteId)
    {
        $pacienteId = Paciente::where('user_id', $pacienteId)->value('id');
    

        $paciente = Paciente::with(['citas.medico'])->findOrFail($pacienteId);
        return view('pacientes.citas', ['paciente' => $paciente]);
    }

    // Método para confirmar la cita
    public function confirmarCita($citaId)
    {
        $cita = Citas::findOrFail($citaId);
        $cita->estado = 1; // Cambiar a confirmado
        $cita->save();

        return redirect()->back()->with('success', 'Cita confirmada.');
    }

    // Método para eliminar la cita
    public function eliminarCita($citaId)
    {
        $cita = Citas::findOrFail($citaId);
        $cita->delete();

        return redirect()->back()->with('success', 'Cita eliminada.');
    }

    public function editarCita($citaId)
    {
        $cita = Citas::findOrFail($citaId);

        // Format the date and time for the view
        $cita->formatted_fecha = $cita->fecha->format('Y-m-d');
        $cita->formatted_hora = date('H:i', strtotime($cita->hora)); // Assuming 'hora' is stored in 'H:i:s' format

        return view('pacientes.editar_cita', [
            'cita' => $cita,
        ]);
    }

    public function actualizarCita(Request $request, $citaId)
    {
        // Encuentra la cita a través del ID
        $cita = Citas::findOrFail($citaId);
    
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora'  => 'required|date_format:H:i', // Asegúrate de que el formato sea 'H:i'
        ]);
    
        // Formatea la hora para que sea compatible con el formato de la base de datos
        $hora = \Carbon\Carbon::createFromFormat('H:i', $validatedData['hora'])->format('H:i:s');
    
        // Actualiza los valores de fecha y hora de la cita con los nuevos datos
        $cita->fecha = $validatedData['fecha'];
        $cita->hora = $hora; // Asigna el valor formateado
    
        // Cambia el estado de la cita a 0 (pendiente)
        $cita->estado = 0;
    
        // Guarda los cambios en la base de datos
        $cita->save();
    
        // Redirige de vuelta con un mensaje de éxito
        return redirect()->route('pacientes.citas', auth()->user()->id)
                         ->with('success', 'Cita actualizada correctamente.');
    }
    
}
