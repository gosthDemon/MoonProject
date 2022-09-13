<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\ValidationsController;

class MedicoController extends Controller
{
    public function userData(){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();

        return $user_data;
    }
    public function showForm(Request $request){
        $especialidades = DB::table('Especialidades')->get();
        $centros_medicos = DB::table('Centros_Medicos')->get();
        $user_data = $this->userData();
        return view('Medico.create',['isOpen'=>'medico/showForm'],compact('especialidades','user_data','centros_medicos'));
    }
    public function create(Request $request){
        $especialidades = DB::table('Especialidades')->get();
        $centros_medicos = DB::table('Centros_Medicos')->get();
        $validate = new ValidationsController();
        $validate->medicoCreate($request);
        $user_data = $this->userData();

        $User_ID = DB::table('users')
            ->insertGetId([
                'name' => $request->nombre ." ".$request->apellidos,
                'email' => $request->carnet."@medico.com",
                'password' =>bcrypt($request->carnet),
                'role' => 'Medico',
                'estado' => 'Active'
            ]);
        DB::table('medicos')
            ->insert([
                'User_ID'=>$User_ID,
                'Especialidad_ID' => $request->especialidad,
                'Centromedico_ID' => $request->centro_medico,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'carnet'=>$request->carnet,
                'fecha_nacimiento'=>$request->fecha_nacimiento,
                'telefono'=>$request->telefono,
                'fichas'=>0
            ]);

        return view('Medico.create',['register'=>'true', 'isOpen'=>'medico/showForm'],compact('user_data','especialidades','centros_medicos'));

    }
    public function showAll(){
        $user_data = $this->userData();
        $especialidades = DB::table('especialidades')->get();
        $centros_medicos = DB::table('centros_medicos')->get();
        $medicos = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->join('centros_medicos','medicos.Centromedico_ID','=','centros_medicos.ID')
        ->join('especialidades','medicos.especialidad_ID','=','especialidades.ID')
        ->select('medicos.*',
                'centros_medicos.nombre as centro_medico',
                'centros_medicos.id as centro_medico_id',
                'especialidades.nombre as especialidad',
                'especialidades.id as especialidad_id')
        ->where('users.estado','=','Active')
        ->paginate(10);

        return view('Medico.showAll',['isOpen'=>'medico/showAll'],compact('medicos','user_data','especialidades','centros_medicos'));
    }
    public function showAllInactive(){
        $user_data = $this->userData();
        $medicos = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->join('centros_medicos','medicos.Centromedico_ID','=','centros_medicos.ID')
        ->join('especialidades','medicos.especialidad_ID','=','especialidades.ID')
        ->select('medicos.*',
                'centros_medicos.nombre as centro_medico',
                'centros_medicos.id as centro_medico_id',
                'especialidades.nombre as especialidad',
                'especialidades.id as especialidad_id')
        ->where('users.estado','=','Inactive')
        ->paginate(10);

        return view('Medico.showAllInactive',['isOpen'=>'medico/showAll'],compact('medicos','user_data'));
    }
    public function search($user){
        $medicos = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
        ->join('centros_medicos','medicos.Centromedico_ID','=','centros_medicos.ID')
        ->select('medicos.*','especialidades.ID as especialidad_id','especialidades.nombre as especialidad','centros_medicos.ID as centro_medico_id','centros_medicos.nombre as centro_medico')
        ->where('users.estado','=','Active')
        ->where(function($query)use($user){
            $query->where('medicos.apellidos','like','%'.$user.'%')
            ->orwhere('medicos.carnet','like','%'.$user.'%');
            })->get();
        return $medicos;
    }
    public function searchInactive($user){
        $medicos = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->join('especialidades','medicos.Especialidad_ID','=','especialidades.ID')
        ->join('centros_medicos','medicos.Centromedico_ID','=','centros_medicos.ID')
        ->select('medicos.*','especialidades.ID as especialidad_id','especialidades.nombre as especialidad','centros_medicos.ID as centro_medico_id','centros_medicos.nombre as centro_medico')
        ->where('users.estado','=','Inactive')
        ->where(function($query)use($user){
            $query->where('medicos.apellidos','like','%'.$user.'%')
            ->orwhere('medicos.carnet','like','%'.$user.'%');
        })->get();

        return $medicos;
    }
    public function edit(Request $request){
        
        $validate = new ValidationsController();
        $validate->medicoEdit($request);
        
        $medico_register = DB::table('medicos')
            ->where('ID','=', $request->medico_id)
            ->update(['carnet' => $request->carnet,
                    'Especialidad_ID' => $request->especialidad,
                    'Centromedico_ID'=>$request->centro_medico,
                    'nombre' => $request->nombre,
                    'apellidos'=>$request->apellidos,
                    'fecha_nacimiento'=>$request->fecha_nacimiento,
                    
                    'telefono'=>$request->telefono]);
        DB::table('users')
            ->join('medicos','users.id','=','medicos.User_ID')
            ->where('medicos.ID','=', $request->medico_id)
            ->update(['users.email' => $request->carnet.'@medico.com']);

        if (!$medico_register) {
            return redirect(\route('medico/showAll'))->with('update','fail');
        }

        return redirect(\route('medico/showAll'))->with('update','success');
    }
    public function delete(Request $request,$medico_id){
        DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->where('medicos.ID','=',$medico_id)
        ->update(['users.estado' => 'Inactive']);
        return 'true';
    }
    public function active($medico_id){
        $medico = DB::table('medicos')
        ->join('users','medicos.User_ID','=','users.id')
        ->where('medicos.ID','=',$medico_id)
        ->update(['users.estado' => 'Active']);
        if (!$medico) {
            return 'same';
        }
        return 'success';
    }
}
