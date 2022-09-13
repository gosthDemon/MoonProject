<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\ValidationsController;

class CentroMedicoController extends Controller
{
    public function userData(){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();

        return $user_data;
    }
    public function showForm(){
        $user_data = $this->userData();
        return view('Centro Medico.create', ['isOpen'=>'Centro Medico/showForm'],compact('user_data'));
    }
    public function create(Request $request){
        $validate = new ValidationsController();
        $validate->centroMedicoCreate($request);
        $user_data = $this->userData();

        $User_ID = DB::table('users')
            ->insertGetId([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' =>bcrypt('0000'),
                'role' => 'Paciente',
                'estado' => 'Active'
            ]);
        
        DB::table('centros_medicos')
            ->insert([
                'User_ID'=>$User_ID,
                'nivel' => $request->nivel,
                'nombre' => $request->nombre,
                'direccion'=>$request->direccion,
                'telefono'=>$request->telefono
            ]);

        return view('Centro Medico.create',['register'=>'true','isOpen'=>'Centro Medico/create'],compact('user_data')); 
    }
    public function showAll(){
        $user_data = $this->userData();
        $centros_medicos = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('users.estado','=','Active')
        ->paginate(10);
        return view('centro medico.showAll',['isOpen'=>'Centro Medico/showAll'], compact('user_data','centros_medicos'));
    }
    public function showAllInactive(){
        $user_data = $this->userData();
        $centros_medicos = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('users.estado','=','Inactive')
        ->paginate(10);
        return view('Centro Medico.showAllInactive',['isOpen'=>'Centro Medico/showAll'], compact('user_data','centros_medicos',));
    }
    public function search($user){
        $centros_medicos = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('users.estado','=','Active')
        ->where('centros_medicos.nombre','like','%'.$user.'%')->get();
        return $centros_medicos;
    }
    public function searchInactive($user){
    
        $centros_medicos = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('users.estado','=','Inactive')
        ->where('centros_medicos.nombre','like','%'.$user.'%')
        ->get();

        return $centros_medicos;
    }
    public function edit(Request $request){
        $validate = new ValidationsController();
        $validate->centroMedicoEdit($request);

        $centro_medico_register = DB::table('centros_medicos')
            ->where('ID','=', $request->centro_medico_id)
            ->update(['nombre' => $request->nombre,
                    'nivel'=>$request->nivel,
                    'telefono'=>$request->telefono,
                    'direccion'=>$request->direccion]);

        if (!$centro_medico_register) {
            return redirect(route('Centro Medico/showAll'))->with('update','fail');
        }

        return redirect(route('Centro Medico/showAll'))->with('update','success');
    }
    public function delete(Request $request,$centro_medico_id){
        $centro_medico = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('centros_medicos.ID','=',$centro_medico_id)
        ->update(['users.estado' => 'Inactive']);
        
        return $centro_medico;
    }
    public function active($centro_id){
        $centro_medico = DB::table('centros_medicos')
        ->join('users','centros_medicos.User_ID','=','users.id')
        ->where('centros_medicos.ID','=',$centro_id)
        ->update(['users.estado' => 'Active']);
        if (!$centro_medico) {
            return 'same';
        }
        return 'success';
    }
}
