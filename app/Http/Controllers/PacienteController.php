<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\ValidationsController;

class PacienteController extends Controller

{
    public function userData(){
        
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();

        return $user_data;
    }
    public function showForm(){
        $barrios = DB::table('barrios')->get();
        $user_data = $this->userData();
        return view('Paciente.create',['isOpen'=>'paciente/showForm'],compact('user_data','barrios'));
    }
    public function create(Request $request){
        
        $validate = new ValidationsController();
        $validate->pacienteCreate($request);
        $user_data = $this->userData();
        $barrios = DB::table('barrios')->get();

        $User_ID = DB::table('users')
            ->insertGetId([
                'name' => $request->nombre ." ".$request->apellidos,
                'email' => $request->carnet,
                'password' =>bcrypt($request->carnet),
                'role' => 'Paciente',
                'estado' => 'Active'
            ]);
        DB::table('pacientes')
            ->insert([
                'User_ID'=>$User_ID,
                'Barrio_ID' => $request->barrio,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'carnet'=>$request->carnet,
                'fecha_nacimiento'=>$request->fecha_nacimiento,
                'telefono'=>$request->telefono,
                'direccion'=>$request->direccion,
                'strikes'=>0
            ]);

        return view('Paciente.create',['register'=>'success', 'isOpen'=>'paciente/showForm'],compact('user_data','barrios'));
    }
    public function showAll(){
        $barrios = DB::table('barrios')->get();
        $user_data = $this->userData();
        $pacientes = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->join('barrios','pacientes.Barrio_ID','=','barrios.ID')
        ->select('pacientes.*','barrios.nombre as barrio_nombre')
        ->where('users.estado','=','Active')
        ->where('pacientes.strikes','<',3)
        ->paginate(10);
        return view('paciente.showAll',['isOpen'=>'paciente/showAll'], compact('user_data','pacientes','barrios'));
    }
    public function showAllInactive(){
        $barrios = DB::table('barrios')->get();
        $user_data = $this->userData();
        $pacientes = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->join('barrios','pacientes.Barrio_ID','=','barrios.ID')
        ->select('pacientes.*','barrios.nombre as barrio_nombre')
        ->where('users.estado','=','Inactive')
        ->orWhere('pacientes.strikes','>=',3)
        ->paginate(10);
        return view('paciente.showAllInactive',['isOpen'=>'paciente/showAll'], compact('user_data','pacientes','barrios'));
    }
    public function search($user){
        $pacientes = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->join('barrios','pacientes.Barrio_ID','=','barrios.ID')
        ->select('pacientes.*','barrios.nombre as barrio_nombre')
        ->where('users.estado','=','Active')
        ->where('pacientes.strikes','<=',2)
        ->where(function($query)use($user){
            $query->where('pacientes.apellidos','like','%'.$user.'%')
            ->orwhere('pacientes.carnet','like','%'.$user.'%');
            })->get();
        return $pacientes;
    }
    public function searchInactive($user){
    
        $pacientes = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->join('barrios','pacientes.Barrio_ID','=','barrios.ID')
        ->select('pacientes.*','barrios.nombre as barrio_nombre')
        ->where(function($query){
            $query->where('users.estado','=','Inactive')
                    ->orwhere('pacientes.strikes','>=',3);
        })->where(function($query)use($user){
            $query->where('pacientes.apellidos','like','%'.$user.'%')
            ->orwhere('pacientes.carnet','like','%'.$user.'%');
        })->get();

        return $pacientes;
    }
    public function edit(Request $request){
        
        $validate = new ValidationsController();
        $validate->pacienteEdit($request);

        $pacienteRegister = DB::table('pacientes')
            ->where('ID','=', $request->paciente_id)
            ->update(['carnet' => $request->carnet,
                    'nombre' => $request->nombre,
                    'apellidos'=>$request->apellidos,
                    'fecha_nacimiento'=>$request->fecha_nacimiento,
                    'telefono'=>$request->telefono,
                    'direccion'=>$request->direccion,
                    'Barrio_ID'=>$request->barrio]);

        DB::table('users')
            ->join('pacientes','users.id','=','pacientes.User_ID')
            ->where('pacientes.ID','=', $request->medico_id)
            ->update(['users.email' => $request->carnet]);

        if (!$pacienteRegister) {
            return redirect('/paciente/showAll')->with('update','fail');
        }

        return redirect('/paciente/showAll')->with('update','success');
    }
    public function delete(Request $request,$paciente_id){
        $paciente = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->where('pacientes.ID','=',$paciente_id)
        ->update(['users.estado' => 'Inactive']);
        
        return $paciente_id;
    }
    public function active($paciente_id){
        $paciente = DB::table('pacientes')
        ->join('users','pacientes.User_ID','=','users.id')
        ->where('pacientes.ID','=',$paciente_id)
        ->update(['users.estado' => 'Active','pacientes.strikes'=>0]);
        if (!$paciente) {
            return 'same';
        }
        return 'success';
    }
}
