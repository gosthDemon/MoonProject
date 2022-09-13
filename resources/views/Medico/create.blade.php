@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Médico
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
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
            Nuevo Médico
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <form action="/medico/Create" method="POST">
                    <div class="form-group">
                        <label for="carnet">Carnet:</label>
                        <input type="text" class="form-control" id="carnet" name="carnet" aria-describedby="emailHelp" placeholder="Carnet" value="{{ old('carnet') }}" >
                        {{ csrf_field() }}
                        <small id="carnetText" class="form-text alert text-muted">@if ($errors->has('carnet'))
                            <i class="far fa-bar"></i>{{ $errors->first('carnet') }}
                        @endif
                        </small>
                    </div>
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
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"  value="{{ old('apellidos') }}" >
                        {{ csrf_field() }}
                        <small id="apellidosText" class="form-text alert text-muted">@if ($errors->has('apellidos'))
                            <i class="far fa-bar"></i>{{ $errors->first('apellidos') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"   value="{{ old('fecha_nacimiento') }}">
                        {{ csrf_field() }}
                        <small id="fechaNecimientoText" class="form-text alert text-muted">@if ($errors->has('fecha_nacimiento'))
                            <i class="far fa-bar"></i>{{ $errors->first('fecha_nacimiento') }}
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
                        <label for="Centro_Medico">Centro Médico</label>
                        <select class="form-control" id="centro_medico" name="centro_medico" value="{{ old('centro_medico') }}">
                        <option value=""></option>
                        @foreach ($centros_medicos as $centro_medico )
                            <option value="{{ $centro_medico->ID }}" {{ old('centro_medico') == $centro_medico->ID ? 'selected' : '' }}>{{ $centro_medico->nombre }}</option>
                        @endforeach
                        </select>
                        {{ csrf_field() }}
                        <small id="centroMedicoText" class="form-text alert text-muted">@if ($errors->has('centro_medico'))
                            <i class="far fa-bar"></i>{{ $errors->first('centro_medico') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="Especialidad">Especialidad</label>
                        <select class="form-control" id="especialidad" name="especialidad" value="{{ old('especialidad') }}">
                        <option value=""></option>
                        @foreach ($especialidades as $especialidad )
                            <option value="{{ $especialidad->ID }}"  {{ old('especialidad') == $especialidad->ID ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                        @endforeach
                        </select>
                        {{ csrf_field() }}
                        <small id="especialidaText" class="form-text alert text-muted">@if ($errors->has('especialidad'))
                            <i class="far fa-bar"></i>{{ $errors->first('especialidad') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="button btn-submit"><i class="fad fa-save"></i> Guardar</button>
                        <button type="reset" class="button btn-cancel"><i class="fad fa-trash"></i> Cancelar</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-lg-6 container-image">
                <img src="{{ URL::asset('img/forms/createDoctor.webp') }}" class="form-image" alt=""></div>
            </div>
        <div class="card-footer">
        </div>
    </div>
@endsection

@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@isset($register)
    @if ($register == 'true')
        <script>
            window.onload = registrado;
            function registrado(){
                swal({
                    icon: "success",
                    text: "Registrado correctamente."
                });
            }
        </script> 
    @else
        <script>
            window.onload = registrado;
            function registrado(){
                swal({
                    icon: "error",
                    text: "Oops! A ocurrido un problema."
                });
            }
        </script> 
    @endif
@endisset
{{-- Code JS --}}
<script>
    let carnet = document.getElementById('carnet');
    let alert = document.getElementById('carnetText');
    carnet.addEventListener('keyup', function(){
        let carnetValor = document.getElementById('carnet').value;
        alert.innerHTML = '<span class="accept" style="color:green !important;font-size:18px"> El email será: <B>' + carnetValor + "@medico.com</B> </span>";
    })

    $(document).ready(function() {
    const genderOldValue = '{{ old('gender') }}';
    
    if(genderOldValue !== '') {
        $('#gender').val(genderOldValue);
        }
    });
</script>
@endsection