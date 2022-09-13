<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\GeneralController; 
class FichamedicaController extends Controller{
    //FUNCIONES PRINCIPALES
    //Carga la vista para Dedicir el tipo de atencion
    public function decideLevel(){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();
        $hora_actual = $general_controller->getDateTimeNow('H:i:s');
        if($hora_actual <= "23:59:00"){
            return view('ficha_medica.decide_level',['isOpen'=>'Ficha Medica/nueva'],compact('user_data'));
        }else{
            return "El horario de atencion a terminado";
        }
    }
    //Mostrará las citas en espera de aprobacion
    public function shoAllWaitingApprove(){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();
        $hora_actual = $general_controller->getDateTimeNow('H:i:s');
        $hoy = $general_controller->getDateTimeNow('Y-m-d');
        $ayer = $general_controller->getCalculateDateToday('Y-m-d','-1 days');
        $centro_medico_id = $user_data->ID;

        if ($hora_actual > '06:30:00' && $hora_actual < '23:59:00') {
            $waitingApprove = DB::table('fichas_medicas')
            ->join('medicos','fichas_medicas.Medico_ID','=','medicos.ID')
            ->join('pacientes','fichas_medicas.Paciente_ID','=','pacientes.ID')
            ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
            ->select(   'pacientes.nombre as pacienteNombre','pacientes.apellidos as pacienteApellidos',
                        'medicos.nombre as medicoNombre','medicos.apellidos as medicoApellidos',
                        'fichas_medicas.fecha','fichas_medicas.hora','fichas_medicas.ID as fichaID', 'especialidades.nombre as especialidad')
            ->where(function($query) use($hoy,$centro_medico_id){
                $query->where('fichas_medicas.fecha','=',$hoy)
                    ->where('fichas_medicas.hora','<=','23:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting');
            })->orWhere(function($query)use($ayer,$centro_medico_id){
                $query->where('fichas_medicas.fecha','=',$ayer)
                    ->where('fichas_medicas.hora','>=','19:00:00')
                    ->where('fichas_medicas.estado','=','waiting');
            })->paginate(15);

            return view('Ficha_medica.showAllWaitingApprove',['isOpen'=>"none"],compact('user_data','waitingApprove'));
        }else{
            return view('Ficha_medica.showAllWaitingApprove',['isOpen'=>"none"],compact('user_data'));
        }
        
    }
    public function approveAppointment($appointment){
        try {
            DB::table('fichas_medicas')
            ->where('ID','=',$appointment)
            ->update(['estado' => 'approve']);

            return 'true';
        } catch (\Throwable $th) {
            return "false";
        }
    }

    public function approveAppointmentSearch($user){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();
        $hora_actual = $general_controller->getDateTimeNow('H:i:s');
        $hoy = $general_controller->getDateTimeNow('Y-m-d');
        $ayer = $general_controller->getCalculateDateToday('Y-m-d','-1 days');
        $centro_medico_id = $user_data->ID;

        if ($hora_actual > '06:30:00' && $hora_actual < '23:59:00') {
            $waitingApprove = DB::table('fichas_medicas')
            ->join('medicos','fichas_medicas.Medico_ID','=','medicos.ID')
            ->join('pacientes','fichas_medicas.Paciente_ID','=','pacientes.ID')
            ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
            ->select(   'pacientes.nombre as pacienteNombre','pacientes.apellidos as pacienteApellidos',
                        'medicos.nombre as medicoNombre','medicos.apellidos as medicoApellidos',
                        'fichas_medicas.fecha','fichas_medicas.hora','fichas_medicas.ID as fichaID', 'especialidades.nombre as especialidad')
            ->where(function($query) use($hoy,$centro_medico_id,$user){
                $query->where(function($query) use($hoy,$centro_medico_id,$user){
                    $query->where('fichas_medicas.fecha','=',$hoy)
                    ->where('fichas_medicas.hora','<=','23:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.apellidos','LIKE','%'.$user.'%');
                })->orWhere(function($query)use($hoy,$centro_medico_id,$user){
                $query->where('fichas_medicas.fecha','=',$hoy)
                    ->where('fichas_medicas.hora','<=','23:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.nombre','LIKE','%'.$user.'%');
                })->orWhere(function($query)use($hoy,$centro_medico_id,$user){
                $query->where('fichas_medicas.fecha','=',$hoy)
                    ->where('fichas_medicas.hora','<=','23:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.carnet','LIKE','%'.$user.'%');
                });
            })
            ->orWhere(function($query)use($ayer,$centro_medico_id,$user){
                $query->where(function($query) use($ayer,$centro_medico_id,$user){
                    $query->where('fichas_medicas.fecha','=',$ayer)
                    ->where('fichas_medicas.hora','>=','06:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.apellidos','LIKE','%'.$user.'%');
                })->orWhere(function($query)use($ayer,$centro_medico_id,$user){
                $query->where('fichas_medicas.fecha','=',$ayer)
                    ->where('fichas_medicas.hora','>=','06:00:00')
                    ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                    ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.nombre','LIKE','%'.$user.'%');
                })->orWhere(function($query)use($ayer,$centro_medico_id,$user){
                    $query->where('fichas_medicas.fecha','=',$ayer)
                        ->where('fichas_medicas.hora','>=','06:00:00')
                        ->where('fichas_medicas.Centromedico_ID','=',$centro_medico_id)
                        ->where('fichas_medicas.estado','=','waiting')
                    ->where('pacientes.carnet','LIKE','%'.$user.'%');
                });
            })->get();

            return $waitingApprove;
        }else{
            return $error;
        }
    }

    //FUNCIONES SECUNDARIAS
    /*Pregunta si tiene una reservacion el dia de hoy. Osea una cita con el estado de "waiting" */
    public function haveAppointmentReservedToday($Paciente_ID){
        $fecha_actual = (new GeneralController())->getDateTimeNow('Y-m-d');

        $haveReservation = DB::table('fichas_medicas')
        ->where('fecha','=',$fecha_actual)
        ->where('hora','>=','06:00:00')
        ->where('hora','<=','23:59:00')
        ->where('Paciente_ID','=',$Paciente_ID)
        ->where('estado','=','waiting')
        ->count();

        return $haveReservation;
    }
    /*Pregunta si tiene una cita el dia de hoy, sin importar el estado */
    public function haveAppointmentToday($paciente_id,$fecha_actual, $turno){
        $haveAppointment = DB::table('fichas_medicas')
        ->where('fecha','=',$fecha_actual)
        ->where('turno','=',$turno)
        ->where('Paciente_ID','=',$paciente_id)
        ->where('estado','<>','waiting')
        ->count();
        return ($haveAppointment > 0) ? true : false;
    }
    /*Pregunta si tiene derivaciones activas hasta este dia */
    public function haveDerivations($Paciente_ID, $fecha_actual){ 
        $derivations = DB::table('derivaciones')
        ->where('Paciente_ID','=',$Paciente_ID)
        ->where('fecha_final','>=',$fecha_actual)
        ->count();

        return ($derivations > 0) ? true : false;
    }
    /*Dado un paciente, devuelve todas las especialidades a la que esta derivado */
    public function myDerivations($paciente_id){
        $fecha_actual = (new GeneralController())->getDateTimeNow('Y-m-d');
        $Especialidades = DB::table('Derivaciones')
        ->join('pacientes','Derivaciones.Paciente_ID','=','pacientes.ID')
        ->join('especialidades','Derivaciones.Especialidad_ID','=','Especialidades.ID')
        ->select('especialidades.nombre', 'especialidades.ID')
        ->where('pacientes.ID','=',$paciente_id)
        ->where('derivaciones.fecha_final','>=',$fecha_actual)
        ->get();

        return $Especialidades;

    }
    /*Dada una especialidad, paciente y fecha_actual, pregunta si la especialidad coincide con alguna de la lista de especialidades activas para dicho usuario */
    public function itsYourSpecialtyDerived($especialidad_id,$paciente_id,$fecha_actual){
        $derivations = DB::table('derivaciones')
        ->where('derivaciones.fecha_final','>=',$fecha_actual)
        ->where('derivaciones.Paciente_ID','=',$paciente_id)
        ->where('derivaciones.Especialidad_ID','=',$especialidad_id)
        ->count();

        return ($derivations > 0) ? true : false;
    }
    /*Se encarga de alterar el numero de citas disponibles de mi medico luego de registrar una cita*/
    public function alterAppointmentStatus($Medico_ID){
        $appointment = DB::table('medicos')
        ->where('ID','=',$Medico_ID)
        ->first();

        if($appointment->fichas > 0){
            $newappointment = $appointment->fichas - 1;

            DB::table('medicos')
            ->where('ID','=',$Medico_ID)
            ->update(['fichas'=>$newappointment]);
        }
    }
    /*Dada una especialidad, devuelve los medicos disponibles para esa especialidad */
    public function medicalBySpecialty($especialidad_id){
        $Medicos = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
        ->select('medicos.ID','medicos.nombre', 'medicos.apellidos')
        ->where('medicos.Especialidad_ID','=',$especialidad_id)
        ->where('medicos.fichas','>',0)
        ->where('users.estado','=','Active')
        ->get();

        return $Medicos;
    }
    /*Dado un medico, hace un recuento de las citas disponibles para ese medico */
    public function countAppointment($medico_id){
        $count = DB::table('medicos')
        ->where('ID','=',$medico_id)
        ->first();

        return $count->fichas;
    }
    /*Devuelve los datos de la cita de un paciente */
    public function myAppointmentToday(){
        $general_controller = new GeneralController();
        $fecha_actual = $general_controller->getDateTimeNow('Y-m-d');
        $turno = $general_controller->theTurnIs();
        $user_data = $general_controller->userData();
        $myAppointment = DB::table('fichas_medicas')
        ->join('pacientes','fichas_medicas.Paciente_ID','=','pacientes.ID')
        ->join('medicos','fichas_medicas.Medico_ID','=','medicos.ID')
        ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
        ->select('fichas_medicas.nro','fichas_medicas.Paciente_ID as pacienteID','pacientes.nombre as pacienteNombre','pacientes.apellidos as pacienteApellidos',
                'fichas_medicas.Medico_ID as medicoID','medicos.nombre as medicoNombre','medicos.apellidos as medicoApellidos','especialidades.nombre as Especialidad')
        ->where('fecha','=',$fecha_actual)
        ->where('Paciente_ID','=',$user_data->ID)
        ->where('turno','=',$turno)
        ->first();

        return $myAppointment;
    }
    


    //Request XMLHTTP 

    //ficha_medica.waiting
    //Extrae las citas ocupadas para el medico con quien reservé atencion.
    public function showMyTicketPosition(){
        $general_controller = new GeneralController();
        $fecha_actual = $general_controller->getDateTimeNow('Y-m-d');
        $turno = $general_controller->theTurnIs();
        //Nos valemos de esta funcion para extraer el MedicoID para la consulta
        $myAppointment = $this->myAppointmentToday();

        $Citas = DB::table('fichas_medicas')
        ->where('fecha','=',$fecha_actual)
        ->where('Medico_ID','=',$myAppointment->medicoID)
        ->where('turno','=',$turno)
        ->where('estado','<>','waiting')
        ->orderBy('nro','Asc')
        ->get();

        return $Citas;
    }
}
