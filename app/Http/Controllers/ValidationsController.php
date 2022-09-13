<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\GeneralController;

class ValidationsController extends Controller
{
    
    public function pacienteCreate($request){
        $GeneralController = new GeneralController();
        $hoy = $GeneralController->getTodayDate('format');
        $fecha_minima = $GeneralController->getDateSub('format','120','Year');
        $this->validate($request, [
            'carnet' => 'required|max:12|min:5|unique:pacientes,carnet|unique:users,email',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|before_or_equal:'.$hoy.'|after_or_equal:'.$fecha_minima.'|date',
            'telefono' => 'max:10',
            'barrio' => 'required',
            'direccion' => 'required'
        ]);
    }

    public function pacienteEdit($request){
        $GeneralController = new GeneralController();
        $hoy = $GeneralController->getTodayDate('format');
        $fecha_minima = $GeneralController->getDateSub('format','120','Year');
        $this->validate($request, [
            'paciente_id' => 'required',
            'carnet' => 'required|max:12|min:5|unique:pacientes,carnet,'.$request->paciente_id.',ID',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|before_or_equal:'.$hoy.'|after_or_equal:'.$fecha_minima.'|date',
            'telefono' => 'max:10',
            'barrio' => 'required',
            'direccion' => 'required'
        ]);
    }

    public function medicoCreate($request){
        $GeneralController = new GeneralController();
        $mayor_edad = $GeneralController->getDateSub('format','18','Year');
        $fecha_minima = $GeneralController->getDateSub('format','120','Year');
        
        $this->validate($request, [
            'carnet' => 'required|max:12|min:5|unique:medicos,carnet',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|before_or_equal:'.$mayor_edad.'|after_or_equal:'.$fecha_minima.'|date',
            'telefono' => 'max:10',
            'centro_medico' => 'required|integer',
            'especialidad' => 'required|integer'
        ]);
    }

    public function medicoEdit($request){
        $GeneralController = new GeneralController();
        $mayor_edad = $GeneralController->getDateSub('format','18','Year');
        $fecha_minima = $GeneralController->getDateSub('format','120','Year');
        $this->validate($request, [
            'carnet' => 'required|max:12|min:5|unique:medicos,carnet,'.$request->medico_id.',ID',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|before_or_equal:'.$mayor_edad.'|after_or_equal:'.$fecha_minima.'|date',
            'telefono' => 'max:10',
            'centro_medico' => 'required|integer',
            'especialidad' => 'required|integer'
        ]);
    }

    public function centroMedicoCreate($request){
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'nivel' => 'required',
            'telefono' => 'max:10',
            'direccion'=> 'required',
        ]);
    }

    public function centroMedicoEdit($request){
        $this->validate($request, [
            'centro_medico_id' => 'required',
            'nombre' => 'required',
            'nivel' => 'required',
            'telefono' => 'max:10',
            'direccion' => 'required'
        ]);
    }

    public function createForHospital($request){
        $this->validate($request,[
            'especialidad' => 'required|exists:especialidades,ID|integer',
            'medico' => 'required|exists:medicos,ID|integer'
        ]);
    }
}
