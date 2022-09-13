@extends('layouts.GeneralTemplate')

@section('tittle')
    Pacientes 
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Pacientes Inactivos
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Pacientes Inactivos</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <span class="name-page">Pacientes Inactivos</span>
            <span class="new-page"><a href="{{ route('paciente/showAllInactive') }}"><i class="far fa-folder-plus"></i> Pacientes Activos</a></span>
        </div>
        <div class="card-body"> 
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Carnet</th>
                    <th scope="col">Nacimiento</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Barrio</th>
                    <th scope="col">Strikes</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($pacientes as $paciente)
                        <tr id="tr-table">
                            <th scope="row">{{ $paciente->ID }}</th>
                            <td>{{ $paciente->nombre }}</td>
                            <td>{{ $paciente->apellidos }}</td>
                            <td>{{ $paciente->carnet }}</td>
                            <td>{{ $paciente->fecha_nacimiento }}</td>
                            <td>{{ $paciente->telefono }}</td>
                            <td>{{ $paciente->direccion }}</td>
                            <td id="{{ $paciente->Barrio_ID }}">{{ $paciente->barrio_nombre }}</td>
                            <td>{{ $paciente->strikes }}</td>
                            <td><div class="size-delete" id="contentButton"><a href="#" id="activeUser" class="showUser activeUser"><i class="far fa-trash"></i> Activar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pacientes->links() }}
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let searchButton = document.getElementById('searchButton');
    searchButton.addEventListener('click',function(){
        let user = document.getElementById('searchInput').value;
        if(user != ""){
            const http = new XMLHttpRequest();
            const url = "/paciente/searchInactive/"+user;
            http.onreadystatechange = function(){
                if (this.readyState==4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    document.getElementById('table-body').innerHTML = "";
                    response.forEach(paciente => {
                        let addPaciente = `<tr id="tr-table">
                            <th scope="row">`+paciente.ID+`</th>
                                <td>`+paciente.nombre+`</td>
                                <td>`+paciente.apellidos+`</td>
                                <td>`+paciente.carnet+`</td>
                                <td>`+paciente.fecha_nacimiento+`</td>
                                <td>`+paciente.telefono+`</td>
                                <td>`+paciente.direccion+`</td>
                                <td id="`+paciente.Barrio_ID+`">`+paciente.barrio_nombre+`</td>
                                <td>`+paciente.strikes+`</td>
                                <td><div class="size-delete" ><a href="#" id="activeUser" class="activeUser"><i class="far fa-trash"></i> Activar</a></td>
                            </tr>`;
                        document.getElementById('table-body').innerHTML += addPaciente;
                    });
                }
            }
            http.open('GET', url);
            http.send();
        }
    })

    /*Activar Usuario Function*/
    $("#table-body").on("click", ".activeUser", function(){
    
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Esto reactivará a este paciente del registro!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#63B7AF',
            cancelButtonColor: '#EE8572',
            confirmButtonText: '¡Si, reactiva esto!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let new_element = this.parentNode;
                    let father = new_element.parentNode;
                    let grandparent = father.parentNode;
                    let paciente_id = grandparent.children[0].innerHTML;
                    const http = new XMLHttpRequest();
                    const url = "/paciente/active/"+paciente_id;
                    http.onreadystatechange = function(){
                        if (this.readyState==4 && this.status == 200) {
                            let response = this.responseText;
                            swal.fire({
                                icon: "success",
                                text: "Tu registro se ha reactivado.",
                                confirmButtonColor: '#63B7AF',
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                    http.open('GET', url);
                    http.send();
                }else{
                    swal.fire({
                        icon: "success",
                        text: "Tu regitro esta a salvo.",
                        confirmButtonColor: '#63B7AF',
                    });
                }
        })

    });

</script>
@endsection