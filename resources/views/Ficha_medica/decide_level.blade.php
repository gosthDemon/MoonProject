@extends('layouts.GeneralTemplate')

@section('tittle')
    Ficha Médica
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/ficha.css') }}">
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
            Por favor seleccion el tipo de centro:
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <a href="{{ route('cita/nueva/hospital') }}">
                    <div class="container-centro">
                        <div class="header">
                            Especialidades &nbsp; Hospital
                        </div>
                        <img src="{{ URL::asset('img/fichas/isHospital.webp') }}" alt="">
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <a href="{{ route('cita/nueva/posta') }}">
                    <div class="container-centro">
                        <div class="header">
                            Atencion General&nbsp; &nbsp; Posta Médica
                        </div>
                        <img src="{{ URL::asset('img/fichas/isPosta.webp') }}" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
@endsection

@section('js')
    
@endsection