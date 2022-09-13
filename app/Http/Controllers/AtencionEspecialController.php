<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\FichamedicaController;
class AtencionEspecialController extends Controller{

    public function isHospital(){
        $fichamedica_controller = new FichamedicaController();
        $general_controller = new GeneralController();
        $fecha_actual = $general_controller->getDateTimeNow('Y-m-d');
        $hora_actual = $general_controller->getDateTimeNow('H:i:s');
        $user_data = $general_controller->userData();
        $turno = $general_controller->theTurnIs();
        
        if($fichamedica_controller->haveAppointmentReservedToday($user_data->ID)){
            return view('Ficha_medica.waitingApprove',['isOpen'=>"none"],compact('user_data')); /*Esperando Aprobacion */
        }
        if($fichamedica_controller->haveAppointmentToday($user_data->ID,$fecha_actual,$turno)){
            $myAppointment = $fichamedica_controller->myAppointmentToday();
            return view('Ficha_medica.waiting',['isOpen'=>"null"],compact('user_data','myAppointment'));
        }

        if($hora_actual >= "05:00:00" && $hora_actual <='23:59:00'){//Limitas las fechas hasta las 6:30 y despues de las 20
            if($fichamedica_controller->haveDerivations($user_data->ID,$fecha_actual) == false){
                return view('errores.notHaveDerivations',['isOpen'=>"null"],compact('user_data'));
            }
            $derivaciones_activas = $fichamedica_controller->myDerivations($user_data->ID);
            return view('ficha_medica.isHospital',['isOpen'=>'Ficha Medica/nueva'],compact('user_data','derivaciones_activas'));
        }else{
            return view('errores.outOfTime',['isOpen'=>'Ficha Medica/nueva','For'=>'Hospital'],compact('user_data'));
        }
        
    }
    public function createForHospital(Request $request){
        $general_controller = new GeneralController();
        $fichamedica_controller = new FichamedicaController();
        (new ValidationsController())->createForHospital($request);
        $user_data = $general_controller->userData();
        $fecha = $general_controller->getDateTimeNow('Y-m-d');
        $hora = $general_controller->getDateTimeNow('H:i:s');
        $turno = $general_controller->theTurnIs();

        $citas_disponibles = $fichamedica_controller->countAppointment($request->medico);

        if ($hora >= "06:00:00" && $hora <= "06:30:00") {
            return view('errores.outOfTime',['isOpen'=>'Ficha Medica/nueva','For'=>'Hospital'],compact('user_data'));
        }
        if($fichamedica_controller->haveAppointmentReservedToday($user_data->ID)){
            return view('Ficha_medica.waitingApprove',['isOpen'=>"none"],compact('user_data'));
        }
        if($fichamedica_controller->haveAppointmentToday($user_data->ID,$fecha,$turno)){
            $myAppointment = $fichamedica_controller->myAppointmentToday();
            return view('Ficha_medica.waiting',['isOpen'=>"none"],compact('user_data','myAppointment'));
        }
        if ($citas_disponibles <= 0) {
            return "No contamos con citas disponibles actualmente";
        }

        if($fichamedica_controller->haveDerivations($user_data->ID,$fecha)){
            if ($fichamedica_controller->itsYourSpecialtyDerived($request->especialidad,$user_data->ID,$fecha)==false) {
                return view('errores.haveAError',['isOpen'=>"null"],compact('user_data'));
            }
        }else{
            return view('errores.notHaveDerivations',['isOpen'=>"null"],compact('user_data'));
        }
        
        try {
            $insertAppointment = DB::table('fichas_medicas')
                ->insert(['Paciente_ID' => $user_data->ID,
                        'Medico_ID' => $request->medico,
                        'Centromedico_ID' => 1,
                        'fecha'=>$fecha,
                        'hora'=>$hora,
                        'nro'=>1,
                        'turno'=>'morning',
                        'estado'=>'waiting'
                    ]);
        } catch (\Throwable $th) {
            return view('errores.haveAError',['isOpen'=>"null"],compact('user_data'));
        }

        $fichamedica_controller->alterAppointmentStatus($request->medico);

        return view('Ficha_medica.waitingApprove',['isOpen'=>'Cita/Esperando Aprobacion'],compact('user_data'));
    }

}
