<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GeneralController;
class AdministradorController extends Controller
{
    public function userData(){
        $general_controller = new GeneralController();
        $user_data = $general_controller->userData();

        return $user_data;
    }
    public function dashboard(){
        $user_data = $this->userData();
        return view('Administrador.dashboard',['isOpen'=>'admin/home'],compact('user_data'));
    }
}
