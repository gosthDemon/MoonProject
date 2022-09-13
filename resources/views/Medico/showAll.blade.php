@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Médico
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
@endsection
@section('content')
    <div class="miscellay">
        <div class="page">
            Nuevo Médico
        </div>
        <div class="position-page">
            <span id="role">
                {{ $user_data->role }}
            </span>
            <span class="page">/ Nuevo Médico</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <span class="name-page">Médicos Activos</span>
            <span class="new-page"><a href="{{ route('medico/showAllInactive') }}"><i class="far fa-folder-plus"></i> Medicos Inactivos</a></span>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Centro Médico</th>
                        <th scope="col">Carnet</th>
                        <th scope="col">Fecha Nacimiento</th>
                        <th scope="col">Telefono</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($medicos as $medico)
                        <tr id="tr-table">
                            <th scope="row">{{ $medico->ID }}</th>
                            <td>{{ $medico->nombre }}</td>
                            <td>{{ $medico->apellidos }}</td>
                            <td id="{{ $medico->especialidad_id }}">{{ $medico->especialidad }}</td>
                            <td id="{{ $medico->centro_medico_id }}">{{ $medico->centro_medico }}</td>
                            <td>{{ $medico->carnet }}</td>
                            <td>{{ $medico->fecha_nacimiento }}</td>
                            <td>{{ $medico->telefono }}</td>
                            <td>
                                <div class="size-show">
                                    <a href="#" id="showUser" data-toggle="modal" data-target=".showUserModal" class="showUser"><i class="far fa-eye"></i>
                                        Ver
                                    </a>
                                </div>
                            </td>
                            @if($medico->especialidad_id != 1)
                            <td>
                                <div class="size-delete"><a href="#" id="deleteUser" class="deleteUser"><i class="far fa-trash"></i> Eliminar</a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $medicos->links() }}
        </div>
        <div class="card-footer">
        </div>
    </div>
    <div class="modal fade showUserModal" tabindex="-1" role="dialog" id="modalShow" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="card-header">
                    Modificar Medico
                </div>
                <div class="card-body row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <form action="{{ route('medico/edit') }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="medico_id" name="medico_id"
                                value="{{ old('medico_id') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="carnet">Carnet:</label>
                                <input type="text" class="form-control" id="carnet" name="carnet"
                                    aria-describedby="emailHelp" placeholder="Carnet" value="{{ old('carnet') }}">
                                {{ csrf_field() }}
                                <small id="carnetText" class="form-text alert text-muted">
                                    @if ($errors->has('carnet'))
                                        <i class="far fa-bar"></i>{{ $errors->first('carnet') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                                    value="{{ old('nombre') }}">
                                {{ csrf_field() }}
                                <small id="nombreText" class="form-text alert text-muted">
                                    @if ($errors->has('nombre'))
                                        <i class="far fa-bar"></i>{{ $errors->first('nombre') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    placeholder="Apellidos" value="{{ old('apellidos') }}">
                                {{ csrf_field() }}
                                <small id="apellidosText" class="form-text alert text-muted">
                                    @if ($errors->has('apellidos'))
                                        <i class="far fa-bar"></i>{{ $errors->first('apellidos') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="especialidad">Especialidad</label>
                                <select class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad') }}">
                                    <option value=""></option>
                                    @foreach ($especialidades as $especialidad)
                                        <option value="{{ $especialidad->ID }}"
                                            {{ old('especialidad') == $especialidad->ID ? 'selected' : '' }}>{{ $especialidad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                {{ csrf_field() }}
                                <small id="especialidadText" class="form-text alert text-muted">
                                    @if ($errors->has('especialidad'))
                                        <i class="far fa-bar"></i>{{ $errors->first('especialidad') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="centro_medico">Centro Médico</label>
                                <select class="form-control" id="centro_medico" name="centro_medico" value="{{ old('centro_medico') }}">
                                    <option value=""></option>
                                    @foreach ($centros_medicos as $centro_medico)
                                        <option value="{{ $centro_medico->ID }}"
                                            {{ old('centro_medico') == $centro_medico->ID ? 'selected' : '' }}>{{ $centro_medico->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                {{ csrf_field() }}
                                <small id="centroMedicoText" class="form-text alert text-muted">
                                    @if ($errors->has('centro_medico'))
                                        <i class="far fa-bar"></i>{{ $errors->first('centro_medico') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento') }}">
                                {{ csrf_field() }}
                                <small id="fechaNacimientoText" class="form-text alert text-muted">
                                    @if ($errors->has('fecha_nacimiento'))
                                        <i class="far fa-bar"></i>{{ $errors->first('fecha_nacimiento') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono"
                                    placeholder="Telefono" value="{{ old('telefono') }}">
                                {{ csrf_field() }}
                                <small id="telefonoText" class="form-text alert text-muted">
                                    @if ($errors->has('telefono'))
                                        <i class="far fa-bar"></i>{{ $errors->first('telefono') }}
                                    @endif
                                </small>
                            </div>
                            <div class="form-buttons">
                                <button type="submit" class="button btn-submit"><i class="fad fa-save"></i>
                                    Guardar</button>
                                <button class="button btn-cancel" data-dismiss="modal"><i class="fad fa-trash"></i>
                                    Cancelar</button>
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
            $(document).ready(function() {
                $('#modalShow').modal('toggle')
            });
        </script>
    @endif
    @if (session('update'))
        @if (session('update') == 'success')
            <script>
                window.onload = modificado;

                function modificado() {
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

                function modificado() {
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
            let Medico_id = grandparent.children[0].innerHTML;
            document.getElementById('medico_id').value = grandparent.children[0].innerHTML;
            document.getElementById('nombre').value = grandparent.children[1].innerHTML;
            document.getElementById('apellidos').value = grandparent.children[2].innerHTML;
            document.getElementById('especialidad').value = grandparent.children[3].id;
            document.getElementById('centro_medico').value = grandparent.children[4].id;
            document.getElementById('carnet').value = grandparent.children[5].innerHTML;
            document.getElementById('fecha_nacimiento').value = grandparent.children[6].innerHTML;
            document.getElementById('telefono').value = grandparent.children[7].innerHTML;
        })

        let searchButton = document.getElementById('searchButton');
        searchButton.addEventListener('click', function() {
            let user = document.getElementById('searchInput').value;
            let routeAux = "{{ route('medico/search', 'req_id') }}";
            var route = routeAux.replace('req_id', user)
            if (user != "") {
                const http = new XMLHttpRequest();
                const url = route;
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = JSON.parse(this.responseText);
                        document.getElementById('table-body').innerHTML = "";
                        response.forEach(medico => {
                            let addMedico = `<tr id="tr-table">
                            <th scope="row">` + medico.ID + `</th>
                                <td>` + medico.nombre + `</td>
                                <td>` + medico.apellidos + `</td>
                                <td id="`+medico.especialidad_id+`">` + medico.especialidad + `</td>
                                <td id="`+medico.centro_medico_id+`">` + medico.centro_medico + `</td>
                                <td>` + medico.carnet + `</td>
                                <td>` + medico.fecha_nacimiento + `</td>
                                <td>` + medico.telefono + `</td>
                                <td><div class="size-show"><a href="#" id="showUser" data-toggle="modal" data-target=".showUserModal" value="` +
                                medico.ID + `" class="showUser" ><i class="far fa-eye"></i> Ver</a></div> </td>
                                <td><div class="size-delete"><a href="#" id="deleteUser" class="deleteUser"><i class="far fa-trash"></i> Eliminar</a></td>
                            </tr>`;
                            document.getElementById('table-body').innerHTML += addMedico;
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
                text: "¡Esto eliminara al médico del registro!",
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
                    let medico_id = grandparent.children[0].innerHTML;
                    let routeAux = "{{ route('medico/delete', 'req_id') }}";
                    var route = routeAux.replace('req_id', medico_id)
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
