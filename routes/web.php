<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CentroMedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\FichamedicaController;
use App\Http\Controllers\AtencionEspecialController;
use App\Http\Controllers\AtencionGeneralController;
use App\Http\Controllers\GeneralController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect ('/login');
});

Route::get('/dashboard', [GeneralController::class,'redirectAfterLogin'])->middleware(['auth'])->name('dashboard');
    
    Route::get('/password', [MedicoController::class, 'password']);
//General
    Route::get('/general/userData', [GeneralController::class, 'userData'])->name('')->middleware('auth');

//Administrador
    Route::get('/admin/dashboard', [AdministradorController::class, 'dashboard'])->name('admin/dashboard');

//Centro Medico
    Route::get('/centro medico/create', [CentroMedicoController::class, 'showForm'])                        ->name('centro medico/showForm')            ->middleware('auth');
    Route::post('/centro medico/create', [CentroMedicoController::class, 'create'])                         ->name('centro medico/create')              ->middleware('auth');
    Route::get('/centro medico/showAll', [CentroMedicoController::class, 'showAll'])                        ->name('centro medico/showAll')             ->middleware('auth');
    Route::get('/centro medico/showAllInactive', [CentroMedicoController::class, 'showAllInactive'])        ->name('centro medico/showAllInactive')     ->middleware('auth');
    Route::get('/centro medico/search/{user}', [CentroMedicoController::class, 'search'])                   ->name('centro medico/search')              ->middleware('auth');
    Route::get('/centro medico/searchInactive/{user}', [CentroMedicoController::class, 'searchInactive'])   ->name('centro medico/searchInactive')      ->middleware('auth');
    Route::put('/centro medico/edit/', [CentroMedicoController::class, 'edit'])                             ->name('centro medico/edit')                ->middleware('auth');
    Route::delete('/centro medico/delete/{id}', [CentroMedicoController::class, 'delete'])                  ->name('centro medico/delete')              ->middleware('auth');
    Route::get('/centro medico/active/{id}', [CentroMedicoController::class, 'active'])                     ->name('centro medico/active')              ->middleware('auth');

//Pacientes
    Route::get('/paciente/create', [PacienteController::class, 'showForm'])                     ->name('paciente/showForm')         ->middleware('auth','isAuthenticate:Admin,Paciente,Medico');
    Route::post('/paciente/create', [PacienteController::class, 'create'])                      ->name('paciente/create')           ->middleware('auth');;
    Route::get('/paciente/showAll', [PacienteController::class, 'showAll'])                     ->name('paciente/showAll')          ->middleware('auth');
    Route::get('/paciente/showAllInactive', [PacienteController::class, 'showAllInactive'])     ->name('paciente/showAllInactive')  ->middleware('auth');
    Route::get('/paciente/search/{user}', [PacienteController::class, 'search'])                ->name('paciente/search')           ->middleware('auth');
    Route::get('/paciente/searchInactive/{user}', [PacienteController::class, 'searchInactive'])->name('paciente/searchInactive')   ->middleware('auth');
    Route::put('/paciente/edit/', [PacienteController::class, 'edit'])                          ->name('paciente/edit')             ->middleware('auth');
    Route::delete('/paciente/delete/{id}', [PacienteController::class, 'delete'])               ->name('paciente/delete')           ->middleware('auth');
    Route::get('/paciente/active/{id}', [PacienteController::class, 'active'])                  ->name('paciente/active')           ->middleware('auth');


//Medicos
    Route::get('/medico/create', [MedicoController::class, 'showForm'])                     ->name('medico/showForm')         ->middleware('auth');
    Route::post('/medico/create', [MedicoController::class, 'create'])                      ->name('medico/create')           ->middleware('auth');
    Route::get('/medico/showAll', [MedicoController::class, 'showAll'])                     ->name('medico/showAll')          ->middleware('auth');
    Route::get('/medico/showAllInactive', [MedicoController::class, 'showAllInactive'])     ->name('medico/showAllInactive')  ->middleware('auth');
    Route::get('/medico/search/{user}', [MedicoController::class, 'search'])                ->name('medico/search')           ->middleware('auth');
    Route::get('/medico/searchInactive/{user}', [MedicoController::class, 'searchInactive'])->name('medico/searchInactive')   ->middleware('auth');
    Route::put('/medico/edit/', [MedicoController::class, 'edit'])                          ->name('medico/edit')             ->middleware('auth');
    Route::delete('/medico/delete/{id}', [MedicoController::class, 'delete'])               ->name('medico/delete')           ->middleware('auth');
    Route::get('/medico/active/{id}', [MedicoController::class, 'active'])                  ->name('medico/active')           ->middleware('auth');



//Ficha Medica
    Route::get('/cita', [FichamedicaController::class, 'decideLevel'])                                                          ->name('cita/decideLevel')                  ->middleware('auth','isAuthenticate:Paciente,Medico');
    Route::get('/cita/especialidades/medicos/{especialidad_id}', [FichamedicaController::class, 'medicalBySpecialty'])          ->name('cita/especialidades/medicos')       ->middleware('auth','isAuthenticate:Paciente');            
    Route::get('/cita/medicos/countAppointment/{medico_id}', [FichamedicaController::class, 'countAppointment'])                ->name('cita/medicos/countAppointment')     ->middleware('auth','isAuthenticate:Paciente');          
    Route::get('/cita/aprobar citas', [FichamedicaController::class, 'shoAllWaitingApprove'])                                   ->name('cita/shoAllWaitingApprove')         ->middleware('auth','isAuthenticate:SubAdmin');      
    Route::post('/cita/aprobar citas/{cita}', [FichamedicaController::class, 'approveAppointment'])                             ->name('cita/approveAppointment')           ->middleware('auth','isAuthenticate:SubAdmin');      
    Route::get('/cita/aprobar citas/search/{user}', [FichamedicaController::class, 'approveAppointmentSearch'])                ->name('cita/approveAppointment/search')    ;      
    Route::post('/cita/esperando aprobacion', [FichamedicaController::class, 'waitingApprove'])                                 ->name('cita/waitingApprove')               ->middleware('auth','isAuthenticate:Paciente');      
    Route::get('/cita/citas medicas activas', [FichamedicaController::class, 'showMyTicketPosition'])                           ->name('cita/showMyTicketPosition');

//Atencion Especial
    Route::get('/atencion especial/nueva', [AtencionEspecialController::class, 'isHospital'])                                            ->name('cita/nueva/hospital')               ->middleware('auth','isAuthenticate:Paciente');
    Route::post('/atencion especial/nueva', [AtencionEspecialController::class, 'createForHospital'])                                   ->name('cita/create/hospital')              ->middleware('auth','isAuthenticate:Paciente');      

//Atencion General
    Route::get('/atencion general/nueva', [AtencionGeneralController::class, 'isPosta'])                                                  ->name('cita/nueva/posta')                  ->middleware('auth','isAuthenticate:Paciente');
    

    

Route::get('/prueba2', [GeneralController::class, 'theTurnIs']);
    
require __DIR__.'/auth.php';
