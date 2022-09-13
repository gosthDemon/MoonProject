<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\FichamedicaController;

class AtencionGeneralController extends Controller
{
    public function isPosta(){

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
            return view('ficha_medica.isPosta',['isOpen'=>'Ficha Medica/nueva','paciente_id'=>$user_data->ID],compact('user_data'));
        }else{
            return view('errores.outOfTime',['isOpen'=>'Ficha Medica/nueva','For'=>'Hospital'],compact('user_data'));
        }
    
        
    }
}
