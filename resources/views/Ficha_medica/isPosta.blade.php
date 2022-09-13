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
            Seleccione su ficha medica:
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                <div class="header-appointment">Registrar Ficha</div>
                
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 ">
                <div><img id="consejo" src="{{url::asset('img/fichas/no-olvide.webp') }}" alt=""></div>
                <button class="tell-me-more " data-toggle="modal" data-target=".tell-me-more-modal">¡Cuéntame mas!</button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
@endsection

@section('js')
    
@endsection