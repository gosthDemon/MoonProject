@extends('layouts.GeneralTemplate')

@section('tittle')
    Ficha Médica
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/ficha.css') }}">
    <style>
        .body{
            padding-top: 0px;
        }
        .tickets{
            
        }
        .item{
            width: 75px;
            height: 75px;
            padding: 0px;
            display: inline-block;
            border-radius: 100%;
            border: 3px solid rgb(120, 202, 214);
        }
        .item img{
            width: 100%;
            height: 100%;
            border-radius:100%;
            margin-bottom: 3px
        }
        .data .label{
            text-align: right;
            font-weight: bold;
            margin: 0px;
            padding: 0px;
            padding-top: 3px;
        }
        .data .date{
            padding-top: 3px
        }
    </style>
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
            <div class="col-12 col-md-6 col-lg-6 col-xl-6" >
                <center id="tickets">
                    No existen tickets
                </center>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <h1>Datos de Mi Cita</h1>
                <p>Nombre: {{ $myAppointment->medicoNombre ." ". $myAppointment->medicoApellidos}}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
    
    
@endsection

@section('js')
    @php
        $Paciente_ID = $user_data->ID 
    @endphp
    
    <script>

        function loadAppointmentTurn(){
        const http = new XMLHttpRequest();
        const url =  "{{ route('cita/showMyTicketPosition') }}";
        http.onreadystatechange = function(){
            if (this.readyState==4 && this.status == 200) {
                let Fichas =  JSON.parse(this.responseText);
                    console.log(Fichas);
                    document.getElementById('tickets').innerHTML="";
                    Fichas.forEach(dato => {
                        if (dato.Paciente_ID == {{ $Paciente_ID }}) {
                            const div = document.createElement("div");
                            div.style.marginRight = "5px";
                            div.className = "item";

                                let estado = dato.estado;
                                if (estado == 'attend') {
                                    div.innerHTML= '<img src="{{URL::asset('img/icons/check-icon.webp') }}">'+"Atendido"+'';
                                    document.getElementById('tickets').appendChild(div);
                                }else{
                                    div.innerHTML= '<img src="{{URL::asset('img/icons/waiting-icon.webp') }}">'+"Mi Cita"+'';
                                    document.getElementById('tickets').appendChild(div);
                                }
                        }else{
                            const div = document.createElement("div");
                            div.style.marginRight = "5px";
                            div.className = "item";

                            let estado = dato.estado;

                            if (estado== 'attend') {
                                div.innerHTML= '<img src="{{URL::asset('img/icons/check-icon.webp') }}">'+"Atendido"+'';
                            document.getElementById('tickets').appendChild(div);
                            }else{
                                div.innerHTML= '<img src="{{URL::asset('img/icons/waiting-icon.webp') }}">'+"En Espera"+'';
                            document.getElementById('tickets').appendChild(div);
                            }
                        }
                    });
            }
        }
        http.open('GET', url);
        http.send(); 
    }
    window.onload = loadAppointmentTurn; 
    setInterval('loadAppointmentTurn()',10000);
    </script>
@endsection