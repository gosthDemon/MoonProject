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
            Seleccione su ficha médicas:
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                <div class="header-appointment">Registrar Ficha</div>
                <form action="{{ route('cita/create/hospital') }}" method="POST" >
                    <div class="form-group">
                        <label for="Especialidad">Especialidad (Solo mostrará las derivaciones activas)</label>
                        <select class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad') }}">
                            <option hidden>Por favor seleccione una Especialidad</option>
                            @foreach ($derivaciones_activas as $derivation)
                                <option value="{{ $derivation->ID }}"  {{ old('especialidad') == $derivation->ID ? 'selected' : '' }}>{{ $derivation->nombre }}</option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                        <small id="especialidadText" class="form-text alert text-muted">@if ($errors->has('especialidad'))
                            <i class="far fa-bar"></i>{{ $errors->first('especialidad') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="Medico">Medico</label>
                        <select class="form-control" id="medico" name="medico" value="{{ old('medico') }}">
                            <option hidden>Por favor seleccione una Médico</option>
                        </select>
                        {{ csrf_field() }}
                        <small id="barrioText" class="form-text alert text-muted">@if ($errors->has('medico'))
                            <i class="far fa-bar"></i>{{ $errors->first('medico') }}
                        @endif
                        </small>
                    </div>
                    <center><span id="messageNroAppointment"></span></center> 
                    <div class="container-button">
                        <button type="submit" class="reserve">Reservar</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 ">
                <div><img id="consejo" src="{{url::asset('img/fichas/no-olvide.webp') }}" alt=""></div>
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
                    <p class="text-considerations"> Las citas médicas para las distintas especialidades que ofrece el hospital son limitadas, por ende, es indispensable asegurarnos de que asistirá a la misma.</p>
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
    <script>
        let especialidad = document.getElementById('especialidad');

        especialidad.addEventListener('change',(event)=>{
            especialidad = document.getElementById('especialidad').value;
            if (especialidad != 0) {
                let routeAux = "{{ route('cita/especialidades/medicos', 'req_id') }}";
                var route = routeAux.replace('req_id', especialidad)
                const http = new XMLHttpRequest();
                const url = route;
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let medicos = JSON.parse(this.responseText);
                        let input = document.getElementById('medico');
                        var i = 0;
                        if(medicos.length > 0){
                            for (let i = input.length; i >= 1; i--) {
                                input.remove(i);
                            }
                            medicos.forEach(medico => {
                                i = i+1;
                                input.options[i]   = new Option(medico.nombre+" "+medico.apellidos,medico.ID);
                            });
                        }else{
                            for (let i = input.length; i >= 1; i--) {
                                input.remove(i);
                            }
                        }
                    }
                }
                http.open('GET', url);
                http.send();
            }
        })

        let medico = document.getElementById('medico');
        medico.addEventListener('change',(event)=>{
            medico = document.getElementById('medico').value;
            if (medico != 0) {
                let routeAux = "{{ route('cita/medicos/countAppointment', 'req_id') }}";
                var route = routeAux.replace('req_id', medico)
                const http = new XMLHttpRequest();
                const url = route;
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let fichas = this.responseText;
                        document.getElementById('messageNroAppointment').innerHTML="Este medico cuenta con <B>"+fichas+"</B> citas disponibles."
                    }
                }
                http.open('GET', url);
                http.send();
            }
        })
    </script>
@endsection