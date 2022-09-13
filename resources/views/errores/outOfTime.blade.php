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
            Seleccione su ficha medica:
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div><img id="consejo" src="{{url::asset('img/fichas/time-out.webp') }}" alt="" class="image-error"></div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                @if ($For=="Hospital")
                    <h1 class="title">Ups! Se agotó el tiempo</h1>
                    <h3 class="title-reserved">El horario de atencion a concluido</h3>
                    <p class="text">El sistema se habilitará de <B class="color-primary">06:00 AM a 6:30 AM </B> para el hospital... esto con el fin de evitar saturación en el sistema. Esperamos su comprensión.</p>
                
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
    
@endsection

@section('js')
    
@endsection