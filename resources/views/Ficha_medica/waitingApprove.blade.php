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
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <img src="{{ URL::asset('img/fichas/time-out.webp')}}" alt="" class="waitingApproveTime-Out"></div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <h1 class="title">Cita medica reservada</h1>
                <h3 class="title-reserved">Usted esta en espera</h3>
                <p class="message-waiting-approve">Su cita médica ha sido reservada, para hacerla efectiva, deberá presentar su orden de derivacion en el area de <B>Fichaje</B> del hospital hasta <B>antes de las 7:15am</B></p>
                <button class="tell-me-more " data-toggle="modal" data-target=".tell-me-more-modal">¡Cuéntame mas!</button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
    <div class="modal fade tell-me-more-modal " tabindex="-1" role="dialog" id="tell-me-more-modal" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="card-header">
                    ¿Cómo registramos las citas médicas?
                </div>
                <div class="card-body row">
                    <p class="considerations">Consideraciones</p>
                    <p class="text-considerations">¡Hey, hola! Dejame contarte un poco sobre como funciona el <B>sistema de reserva de citas médicas</B> en la versión <B>Hospital</B></p>
                    <p class="text-considerations">Las citas médicas para las distintas especialidades que ofrece el hospital son limitadas, por ende, es indispensable asegurarnos de que asistirá a la misma.</p>
                    <p class="text-considerations">Bien, como te habras dado cuenta, es un poco distinto al modelo para <B>Postas médicas,</B> esto se debe principalmente a que en el hospital las citas estan mas limitadas y se necesita de una <B>orden de derivación</B> para acceder a ellas.</p>
                    <p class="text-considerations">La plataforma es nueva, por ende <B>muchas personas aun seguirán asistiendo personalmente al hospital para hacer su reserva</B>. Con el fin de evitar que estas personas hagan la espera en vano,<B> solo liberamos el 50% de las citas disponibles</B>, y reservamos la otra mitad para las personas que asisten de manera presencial al hospital para agendar su cita.</p>
                    <p class="text-considerations">Al reservar una cita médica en el hospital por medio de la plataforma, usted será enviado a una lista de <B>Reservas en espera de aprobacion.</B> </p>
                    <p class="text-considerations">¡No se asuste! Su cita médica está asegurada, pero, para poder hacer efectiva la reserva, deberá contar con su<B> Orden de derivación</B> la cual deberá de presentar en fichajes del hospital  <B>antes de las 7:15 Am</B> caso contrario su reserva sera <B style="color: #F09382">revocada.</B></p>
                    <p class="text-considerations">El sistema se diseñó con el fin de evitar que los pacientes deban de madrugar a hacer una <B>cola de espera,</B> mas sin embargo, deben de seguirse los protocolos para hacer efectivas estas citas médicas ya que las <B>órdenes de derivación</B> son indispensables al momento de hacer la reserva. Con el tiempo este proceso se reducirá aun más, solo estamos dandole tiempo a la población de acostumbrarse a ello.</p>
                    <p class="text-considerations">Esperamos todo haya quedado claro, estamos trabajando en facilitar tu vida.</p>
                    <p class="considerations">Muchas gracias por leernos</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    
@endsection