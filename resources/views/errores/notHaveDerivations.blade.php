@extends('layouts.GeneralTemplate')

@section('tittle')
    Ficha Médica
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/Errors.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Ficha Médica
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Ficha Médica</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            Error de Derivación
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <img src="{{ URL::asset("img/Errores/Codigo-alterado.webp")}}" alt="" class="image-error"></div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <h1 class="title">Ups! Algo ha salido mal...</h1>
                <h3 class="title-reserved">Usted no ha sido derivado</h3>
                <p class="text">Usted no cuenta con ninguna derivacion activa. Para poder acceder a citas medicas en el hospital es necesario que usted cuente con una <B class="color-primary">DERIVACION.</B> Para acceder a una, debe pasar primero por una <B class="color-primary">Posta Médica</B>, donde un medico evaluará su estado de salud y será quien determine a que especialidad se lo derivará</p>
                <a href="{{ route('cita/decideLevel') }}" class="tell-me-more " >¿Volvemos al principio?</a>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
@endsection

@section('js')
    
@endsection