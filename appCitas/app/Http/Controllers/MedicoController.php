<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\Hospital;
use App\Models\PacienteHospital;
use App\Models\Paciente;
use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Horario;

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

    public function index_pacientes(){
        $usuario = auth()->user();
        $medico = Medico::where('user_id', $usuario->id)->first();
        
        if ($medico) { // Verificamos si se encontró al médico
            $hospital = Hospital::find($medico->hospital_id); // Obtener el hospital del médico
            
            if ($hospital) {
                $pacientesIds = PacienteHospital::where('hospital_id', $hospital->id)
                    ->pluck('paciente_id')
                    ->toArray();

                $pacientes = Paciente::whereIn('id', $pacientesIds)->get();

                return view('medico.pacientes', [
                    'cantidadHospitales' => $pacientes->count(),
                    'nombresPacientes' => $pacientes,
                ]);

            }
        }
    }

    public function verMasPaciente($id)
    {

        $paciente = Paciente::find($id);
        return view('medico.vermasPaciente', [
            'paciente' => $paciente,
           
        ]);
    }

    public function crearCita($pacienteId)
    {
        
        $usuario = auth()->user();
        $medico_id = Medico::where('user_id', $usuario->id)->first();
    
        // Encuentra al médico por su ID
        $medico = Medico::findOrFail($medico_id->id);
        
        $paciente = Paciente::findOrFail($pacienteId);
        

        // Obtiene el ID del hospital del médico
        $hospitalId = $medico->hospital_id;

        $pacientesIds = PacienteHospital::where('hospital_id', $hospitalId)
                    ->pluck('paciente_id')
                    ->toArray();

        $pacientes = Paciente::whereIn('id', $pacientesIds)->get();


        return view('medico.crear_cita', [
            'medico' => $paciente,
            'medicosDelMismoHospital' => $pacientes
        ]);
    }

    private function traducirDiaSemana($dia)
    {
        // Traduce el día de la semana al formato usado en tu modelo
        switch ($dia) {
            case 'Monday':
                return 'Lunes';
            case 'Tuesday':
                return 'Martes';
            case 'Wednesday':
                return 'Miércoles';
            case 'Thursday':
                return 'Jueves';
            case 'Friday':
                return 'Viernes';
            case 'Saturday':
                return 'Sábado';
            case 'Sunday':
                return 'Domingo';
            default:
                return $dia; // Devuelve el mismo día si no hay traducción específica
        }
    }

    public function obtenerHorasDisponibles($fecha, $medico_id)
    {
        $fechaSeleccionada = $fecha;
        

        // Convierte la fecha a un objeto Carbon para obtener el día de la semana
        $diaSemana = \Carbon\Carbon::parse($fechaSeleccionada)->format('l');
        
        // Obtén el día de la semana y conviértelo al formato que usas en tu modelo
        // Por ejemplo, si tu modelo usa "Lunes", "Martes", etc.
        $diaSemana = $this->traducirDiaSemana($diaSemana);
        // Esta función debe adaptarse a tu lógica
        
        // Busca el horario del médico para el día de la semana seleccionado
        $horario = Horario::where('medico_id', $medico_id)
            ->where('dia', $diaSemana)
            ->first();

        if (!$horario) {
            return response()->json([]); // No hay horario para ese día, devuelve lista vacía
        }

        $horaInicio = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
        $horaFin = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_fin);

        // Obtener todas las citas del médico en la fecha seleccionada
        $citas_medico = Citas::where('medico_id', $medico_id)
        ->whereDate('fecha', $fechaSeleccionada)
        ->get();

        $paciente_id = auth()->user()->id;
        $paciente_id = Paciente::where('user_id', $paciente_id)->value('id');


        $citasPaciente = Citas::where('paciente_id', $paciente_id)
        ->whereDate('fecha', $fechaSeleccionada)
        ->get();

        $horasDisponibles = [];

        $horaActual = $horaInicio->copy();

        // Agrega las horas disponibles en intervalos de 1 hora desde la hora de inicio hasta la hora de fin
        while ($horaActual->lt($horaFin)) {
            $horaActualString = $horaActual->format('H:i');
    
            // Verificar si la hora actual está disponible
            $horaOcupada = false;
    
            foreach ($citas_medico as $cita) {
                $horaCita = \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora);
    
                // Si hay una cita existente en esa hora, marcarla como ocupada
                if ($horaActualString === $horaCita->format('H:i')) {
                    $horaOcupada = true;
                    break;
                }
            }

            foreach ($citasPaciente as $cita) {
                $horaCita = \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora);
    
                // Si hay una cita existente en esa hora, marcarla como ocupada
                if ($horaActualString === $horaCita->format('H:i')) {
                    $horaOcupada = true;
                    break;
                }
            }
    
            // Si la hora no está ocupada, agregarla a las horas disponibles
            if (!$horaOcupada) {
                $horasDisponibles[] = $horaActualString;
            }
    
            $horaActual->addHour();
        }

        return response()->json($horasDisponibles);
    }

    public function citasMedico($medicoId)
    {
        $medicoId = Medico::where('user_id', $medicoId)->value('id');
        $medico = Medico::with(['citas.paciente.pacienteHospital'])->findOrFail($medicoId);
        return view('medico.citas', ['medico' => $medico]);
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

        return view('medico.editar_cita', [
            'cita' => $cita,
        ]);
    }

    public function actualizarCitaM(Request $request, $citaId)
    {
        // Encuentra la cita a través del ID
        $cita = Citas::findOrFail($citaId);
    
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'fecha_flat' => 'required|date_format:Y-m-d',
            'hora_flat'  => 'required|date_format:H:i', // Asegúrate de que el formato sea 'H:i'
        ]);

        
        // Formatea la hora para que sea compatible con el formato de la base de datos
        $hora = \Carbon\Carbon::createFromFormat('H:i', $validatedData['hora_flat'])->format('H:i:s');
    
        // Actualiza los valores de fecha y hora de la cita con los nuevos datos
        $cita->fecha = $validatedData['fecha_flat'];
        $cita->hora = $hora; // Asigna el valor formateado
    
        // Cambia el estado de la cita a 0 (pendiente)
        $cita->estado = 0;
    
        // Guarda los cambios en la base de datos
        $cita->save();
    
        // Redirige de vuelta con un mensaje de éxito
        return redirect()->route('medico.citas', auth()->user()->id)
                         ->with('success', 'Cita actualizada correctamente.');
    }


}
