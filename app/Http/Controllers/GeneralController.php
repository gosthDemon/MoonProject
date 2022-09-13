<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GeneralController extends Controller{
    
    public function getDateTimeNow($format){
        date_default_timezone_set('America/La_Paz');
        $now = date($format);
        return $now;
    }
    public function getCalculateDate($date,$format,$calculation){
        $newDate = date($format,strtotime($date.$calculation));
        return $newDate;
    }
    public function getCalculateDateToday($format,$calculation){
        $now = $this->getDateTimeNow('dateTime');
        $newDate = date($format,strtotime($now.$calculation));
        return $newDate;
    }
    public function theTurnIs(){
        $hora = $this->getDateTimeNow('H:i:s');

        if($hora > "06:00:00" && $hora < "13:00:00"){
            return "morning";
        }elseif ($hora > "13:00:00" && $hora <= "23:59:00") {
            return "late";
        }
        
    }
    public function tableIs($role){
        if($role == 'Admin' || $role=='Medico'){
            return "medicos";
        }elseif ($role == 'SubAdmin') {
            return "centros_medicos";
        }elseif ($role == 'Paciente') {
            return 'Pacientes';
        }
    }
    public function userData(){
        
        $id = Auth::ID();
        $role = DB::table('users')->select('role')->where('id','=',$id)->first();
        $table = $this->tableIs($role->role);

        $user_data = DB::table('users')
        ->join($table,$table.'.User_ID','users.id')
        ->select($table.'.*','users.id as user_id','users.role','users.email','users.estado')
        ->where('users.id','=',$id)
        ->first();

        return $user_data;
    }
    public function userRole(){
        $id = Auth::ID();
        $role = DB::table('users')->select('role')->where('id','=',$id)->first();

        return $role->role;
    }

}
