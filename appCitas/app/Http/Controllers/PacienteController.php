<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Hospital;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Horario;
use App\Models\PacienteHospital;
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
    public function asociarHospital($hospital, $nss)
    {
        $pacienteId = auth()->user()->id;
        $pacienteId = Paciente::where('user_id', $pacienteId)->value('id');
        $curp = Paciente::where('id', $pacienteId)->value('curp');

        $registro = PacienteHospital::where('hospital_id', $hospital)
            ->where('nss', $nss)
            ->where('curp', $curp)
            ->first();

        if ($registro) {
            // Si el registro existe, actualiza la asociación con el paciente_id
            $registro->update(['paciente_id' => $pacienteId]);
            return response()->json(['success' => true]);
        } else {
            // Si no existe, devuelve un mensaje de error
            return response()->json(['success' => false, 'message' => 'No se encontró asociación con el hospital y NSS proporcionados.']);
        }
            
    }


    public function verMasHospital($id)
    {
        // Obtener el ID del usuario autenticado
        $paciente_id = auth()->user()->id;
        $paciente_id = Paciente::where('user_id', $paciente_id)->value('id');


        // Buscar en la tabla pacientes_hospitales
        $registro = PacienteHospital::where('paciente_id', $paciente_id)
                                ->where('hospital_id', $id)
                                ->exists();
        // Utiliza el parámetro $id para obtener la información del hospital
        $hospital = Hospital::with('user')->find($id);

        // Recupera los médicos asociados a este hospital
        $medicos = Medico::where('hospital_id', $id)->get();
        // Pasa tanto la información del hospital como la lista de médicos a tu vista
        return view('pacientes.verMasHospital', [
            'hospital' => $hospital,
            'medicos' => $medicos,
            'registro' => $registro,
        ]);
    }

    public function verMasDoc($id)
    {

        $medico = Medico::with('hospital')->find($id);
        $horarios = Horario::where('medico_id', $medico->id)->get();
        return view('pacientes.verMasDoctor', [
            'medico' => $medico,
            'registro'=> $registro,
            'horarios' => $horarios,
        ]);
    }
    public function crearCita($medicoId)
    {
        // Encuentra al médico por su ID
        $medico = Medico::findOrFail($medicoId);

        // Obtiene el ID del hospital del médico
        $hospitalId = $medico->hospital_id;

        // Encuentra todos los médicos que pertenecen al mismo hospital
        $medicosDelMismoHospital = Medico::where('hospital_id', $hospitalId)->get();

        return view('pacientes.crear_cita', [
            'medico' => $medico,
            'medicosDelMismoHospital' => $medicosDelMismoHospital
        ]);
    }

    public function guardarCita(Request $request)
    {
        // Validación de datos
        $request->validate([
            'medicos' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
        ], [
            'medicos.required' => 'El campo médico es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'hora.required' => 'El campo hora es obligatorio.',
        ]);
        $paciente_id = auth()->user()->id;
        $paciente_id = Paciente::where('user_id', $paciente_id)->value('id');


        // Guardar la cita en la base de datos
        $cita = new Citas([
            'medico_id' => $request->input('medicos'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'estado'=>0,
            'paciente_id'=>$paciente_id,
        ]);

        $cita->save();

        // Puedes redirigir a una página de confirmación o a donde necesites después de guardar la cita
        return redirect()->route('pacientes.citas',['paciente' => auth()->user()->id]);
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
