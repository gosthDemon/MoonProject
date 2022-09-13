@extends('layouts.GeneralTemplate')

@section('tittle')
    Centros Medicos 
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Centros Medicos Inactivos
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Centros Inactivos</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <span class="name-page">Centros Inactivos</span>
            <span class="new-page"><a href="{{ route('centro medico/showAll') }}"><i class="far fa-folder-plus"></i> Centros Activos</a></span>
        </div>
        <div class="card-body"> 
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($centros_medicos as $centro_medico)
                        <tr id="tr-table">
                            <th scope="row">{{ $centro_medico->ID }}</th>
                            <td>{{ $centro_medico->nombre }}</td>
                            <td>{{ $centro_medico->nivel }}</td>
                            <td>{{ $centro_medico->telefono }}</td>
                            <td>{{ $centro_medico->direccion }}</td>
                            <td><div class="size-delete"><a href="#" id="activeUser" class="activeUser"><i class="far fa-trash"></i> Activar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $centros_medicos->links() }}
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
            let routeAux = "{{ route('centro medico/searchInactive', 'req_id') }}";
            var route = routeAux.replace('req_id', user)
            const http = new XMLHttpRequest();
            const url = route;
            http.onreadystatechange = function(){
                if (this.readyState==4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    document.getElementById('table-body').innerHTML = "";
                    response.forEach(centro_medico => {
                        let addCentroMedico = `<tr id="tr-table">
                            <th scope="row">`+centro_medico.ID+`</th>
                                <td>` + centro_medico.nombre + `</td>
                                <td>` + centro_medico.nivel + `</td>
                                <td>` + centro_medico.telefono + `</td>
                                <td>` + centro_medico.direccion + `</td>
                                <td><div class="size-delete" ><a href="#" id="activeUser" class="activeUser"><i class="far fa-trash"></i> Activar</a></td>
                            </tr>`;
                        document.getElementById('table-body').innerHTML += addCentroMedico;
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
            text: "¡Esto reactivará a este centro del registro!",
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
                    let centro_id = grandparent.children[0].innerHTML;
                    let routeAux = "{{ route('centro medico/active', 'req_id') }}";
                    var route = routeAux.replace('req_id', centro_id)
                    const http = new XMLHttpRequest();
                    const url = route;
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
                        timer:1000
                    });
                }
        })
    });

</script>
@endsection