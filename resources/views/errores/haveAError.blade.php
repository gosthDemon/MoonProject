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
                <img src="{{ URL::asset("img/Errores/General-Error.webp")}}" alt="" class="image-error"></div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <h1 class="title">Ups! Algo ha salido mal...</h1>
                <h3 class="title-reserved">Código fracturado</h3>
                <p class="text">!Oh no¡ Algo ha salido mal con la ejecución del código. Esto quizas se deba a la intrución de código malicioso. <b class="color-primary">Inténtelo de nuevo.</b></p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
@endsection

@section('js')
    
@endsection