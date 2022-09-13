@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Paciente
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Nuevo Paciente
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Nuevo Paciente</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <span class="name-page">En espera de aprobacion</span>
        </div>
        <div class="card-body">
            @if (isset($waitingApprove))
                <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Medico</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($waitingApprove as $appointment)
                        <tr id="tr-table">
                            <th scope="row">{{ $appointment->fichaID }}</th>
                            <td>{{ $appointment->pacienteNombre ." ".$appointment->pacienteApellidos  }}</td>
                            <td>{{ $appointment->medicoNombre ." ". $appointment->medicoApellidos}}</td>
                            <td>{{ $appointment->especialidad}}</td>
                            <td>{{ $appointment->fecha }}</td>
                            <td>{{ $appointment->hora }}</td>
                            <td>
                                <div class="size-delete" >
                                    <a href="#" id="activeUser" class="activeUser"><i class="far fa-check"></i>
                                        Activar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $waitingApprove->links() }}
            @else
                <div class="container row">
                    <div class="col-12 col-md-6 col-lg-7 col-xl-8 image-waitingApprove">
                        <img src="{{ url::asset('img/fichas/time-out.webp') }}" style="width:100%" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-waitingApprove">
                        <h2>¡Aun no es tiempo!</h2>
                        <p>El sistema se abrirá a las 6:00 am</p>
                    </div>
                </div>
            @endif
            
        </div>
        <div class="card-footer">
        </div>
    </div>
    
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /*DELETE PACIENTE*/
        $("#table-body").on("click", ".activeUser", function() {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¿Deseas aprobar esta cita medica?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#63B7AF',
                cancelButtonColor: '#EE8572',
                confirmButtonText: '¡Si, apruebalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let new_element = this.parentNode;
                    let father = new_element.parentNode;
                    let grandparent = father.parentNode;
                    let cita_ID = grandparent.children[0].innerHTML;
                    let routeAux = "{{ route('cita/approveAppointment', 'req_id') }}";
                    var route = routeAux.replace('req_id', cita_ID)
                    let formData = new FormData();
                    formData.append("_method", "POST");
                    formData.append("_token", "{{ csrf_token() }}"); // sólo en blade
                    const http = new XMLHttpRequest();
                    const url = route;
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let response = this.responseText;
                            
                            if(response == "true"){
                                swal.fire({
                                    icon: "success",
                                    text: "La cita ha sido aprobada.",
                                    confirmButtonColor: '#63B7AF',
                                    timer: 1000
                                });
                                window.location.reload();
                            }else{
                                swal.fire({
                                    icon: "error",
                                    text: "UPS! Ocurrió un problema.",
                                    confirmButtonColor: '#63B7AF',
                                    timer: 1000
                                });
                                window.location.reload();
                            }
                        }
                    }
                    http.open('POST', url);
                    http.send(formData);
                } else {
                    swal.fire({
                        icon: "success",
                        text: "Tu regitro esta a salvo.",
                        confirmButtonColor: '#63B7AF',
                    });
                }
            })
        })

        let searchButton = document.getElementById('searchButton');
        searchButton.addEventListener('click', function() {
            let user = document.getElementById('searchInput').value;
            let routeAux = "{{ route('cita/approveAppointment/search', 'req_id') }}";
            var route = routeAux.replace('req_id', user)
            if (user != "") {
                const http = new XMLHttpRequest();
                const url = route;
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = JSON.parse(this.responseText);
                        document.getElementById('table-body').innerHTML = "";
                        response.forEach(cita => {
                            let addCita = `<tr id="tr-table">
                            <th scope="row">`+cita.fichaID+`</th>
                            <td>`+cita.pacienteNombre+` `+cita.pacienteApellidos+`</td>
                            <td>`+cita.medicoNombre+` `+cita.medicoApellidos+`</td>
                            <td>`+cita.especialidad+`</td>
                            <td>`+cita.fecha+`</td>
                            <td>`+cita.hora+`</td>
                            <td>
                                <div class="size-delete" >
                                    <a href="#" id="activeUser" class="activeUser"><i class="far fa-check"></i>
                                        Activar
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                            document.getElementById('table-body').innerHTML += addCita;
                        console.log(cita);
                        });
                    }
                }
                http.open('GET', url);
                http.send();
            }
        })
    </script>
@endsection
