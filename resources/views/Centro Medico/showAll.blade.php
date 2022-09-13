@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Centro Médico
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Nuevo Centro Médico
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Nuevo Centro</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <span class="name-page">Centros Activos</span>
            <span class="new-page"><a href="{{ route('centro medico/showAllInactive') }}"><i class="far fa-folder-plus"></i> Centros Inactivos</a></span>
        
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
                            <td><div class="size-show"><a href="#" id="showUser" data-toggle="modal" data-target=".showUserModal" class="showUser" ><i class="far fa-eye"></i> Ver</a></div> </td>
                            <td><div class="size-delete"><a href="#" id="deleteUser" class="deleteUser"><i class="far fa-trash"></i> Eliminar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $centros_medicos->links() }}
        </div>
        <div class="card-footer">
        </div>
    </div>
    <div class="modal fade showUserModal" tabindex="-1" role="dialog" id="modalShow" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="card-header">
                    Hola
                </div>
                <div class="card-body row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <form action="{{ route('centro medico/edit') }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="centro_medico_id" name="centro_medico_id" value="{{ old('centro_medico_id') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"  value="{{ old('nombre') }}" >
                                {{ csrf_field() }}
                                <small id="nombreText" class="form-text alert text-muted">@if ($errors->has('nombre'))
                                    <i class="far fa-bar"></i>{{ $errors->first('nombre') }}
                                @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="nivel">Nivel:</label>
                                <select class="form-control" id="nivel" name="nivel" value="{{ old('nivel') }}">
                                    <option value=""></option>
                                        <option value="Hospital"
                                            {{ old('nivel') == 'Hospital' ? 'selected' : '' }}>Hospital
                                        </option>
                                        <option value="Posta Medica"
                                            {{ old('nivel') == 'Posta Medica' ? 'selected' : '' }}>Posta Medica
                                        </option>
                                    
                                </select>
                                {{ csrf_field() }}
                                <small id="nivelText" class="form-text alert text-muted">
                                    @if ($errors->has('nivel'))
                                        <i class="far fa-bar"></i>{{ $errors->first('nivel') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono"  value="{{ old('telefono') }}">
                                {{ csrf_field() }}
                                <small id="telefonoText" class="form-text alert text-muted">@if ($errors->has('telefono'))
                                    <i class="far fa-bar"></i>{{ $errors->first('telefono') }}
                                @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"  value="{{ old('direccion') }}">
                                {{ csrf_field() }}
                                <small id="direccionText" class="form-text alert text-muted">@if ($errors->has('direccion'))
                                    <i class="far fa-bar"></i>{{ $errors->first('direccion') }}
                                @endif
                                </small>
                            </div>
                            
                            <div class="form-buttons">
                                <button type="submit" class="button btn-submit"><i class="fad fa-save"></i> Guardar</button>
                                <button class="button btn-cancel" data-dismiss="modal"><i class="fad fa-trash"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-lg-6 container-image">
                        <img src="{{ URL::asset('img/forms/create.webp') }}" class="form-image" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
    <script>
        $( document ).ready(function() {
            $('#modalShow').modal('toggle')
        });
    </script>
@endif
@if (session('update'))
    @if (session('update') == 'success')
        <script>
            window.onload = modificado;
            function modificado(){
                swal.fire({
                    icon: "success",
                    text: "Modificado correctamente.",
                    confirmButtonColor: '#63B7AF',
                });
            }
        </script> 
    @else
        <script>
            window.onload = modificado;
            function modificado(){
                swal.fire({
                    icon: "error",
                    text: "Oops! Ha ocurrido un problema.",
                    confirmButtonColor: '#63B7AF',
                });
            }
        </script> 
    @endif
@endif
<script>
    $("#table-body").on("click", ".showUser", function() {
        let new_element = this.parentNode;
        let father = new_element.parentNode;
        let grandparent = father.parentNode;
        let paciente_id = grandparent.children[0].innerHTML;
        document.getElementById('centro_medico_id').value = grandparent.children[0].innerHTML;
        document.getElementById('nombre').value = grandparent.children[1].innerHTML;
        document.getElementById('nivel').value = grandparent.children[2].innerHTML;
        document.getElementById('telefono').value = grandparent.children[3].innerHTML;
        document.getElementById('direccion').value = grandparent.children[4].innerHTML;
    })
    let searchButton = document.getElementById('searchButton');
    searchButton.addEventListener('click', function() {
        let user = document.getElementById('searchInput').value;
        let routeAux = "{{ route('centro medico/search', 'req_id') }}";
        var route = routeAux.replace('req_id', user)
        if (user != "") {
            const http = new XMLHttpRequest();
            const url = route;
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    document.getElementById('table-body').innerHTML = "";
                    response.forEach(centro_medico => {
                        let addCentroMedico = `<tr id="tr-table">
                        <th scope="row">` + centro_medico.ID + `</th>
                            <td>` + centro_medico.nombre + `</td>
                            <td>` + centro_medico.nivel + `</td>
                            <td>` + centro_medico.telefono + `</td>
                            <td>` + centro_medico.direccion + `</td>
                            <td><div class="size-show"><a href="#" id="showUser" data-toggle="modal" data-target=".showUserModal" value="` +
                            centro_medico.ID + `" class="showUser" ><i class="far fa-eye"></i> Ver</a></div> </td>
                            <td><div class="size-delete"><a href="#" id="deleteUser" class="deleteUser"><i class="far fa-trash"></i> Eliminar</a></td>
                        </tr>`;
                        document.getElementById('table-body').innerHTML += addCentroMedico;
                    });
                }
            }
            http.open('GET', url);
            http.send();
        }
    })
    /*DELETE PACIENTE*/
    $("#table-body").on("click", ".deleteUser", function() {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Esto eliminara un Centro del registro!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#63B7AF',
            cancelButtonColor: '#EE8572',
            confirmButtonText: '¡Si, elimina esto!'
        }).then((result) => {
            if (result.isConfirmed) {
                let new_element = this.parentNode;
                let father = new_element.parentNode;
                let grandparent = father.parentNode;
                let centro_medico_id = grandparent.children[0].innerHTML;
                let routeAux = "{{ route('centro medico/delete', 'req_id') }}";
                var route = routeAux.replace('req_id', centro_medico_id)
                let formData = new FormData();
                formData.append("_method", "delete");
                formData.append("_token", "{{ csrf_token() }}"); // sólo en blade
                const http = new XMLHttpRequest();
                const url = route;
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = this.responseText;
                        swal.fire({
                            icon: "success",
                            text: "Tu registro se ha eliminado.",
                            confirmButtonColor: '#63B7AF',
                            timer: 1000
                        });
                        window.location.reload();
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
</script>
@endsection