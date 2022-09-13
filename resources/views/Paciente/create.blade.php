@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Paciente
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
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
            Nuevo Paciente
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <form action="{{ route('paciente/create') }}" method="POST">
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
                        <small id="fechaNacimientoText" class="form-text alert text-muted">@if ($errors->has('fecha_nacimiento'))
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
                        <label for="barrio">Barri o Comunidad:</label>
                        <select class="form-control" id="barrio" name="barrio" value="{{ old('barrio') }}">
                            <option value=""></option>
                            @foreach ($barrios as $barrio )
                                <option value="{{ $barrio->ID }}"  {{ old('barrio') == $barrio->ID ? 'selected' : '' }}>{{ $barrio->nombre }}</option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                        <small id="barrioText" class="form-text alert text-muted">@if ($errors->has('barrio'))
                            <i class="far fa-bar"></i>{{ $errors->first('barrio') }}
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
                        <button type="reset" class="button btn-cancel"><i class="fad fa-trash"></i> Cancelar</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-lg-6 container-image">
                <img src="{{ URL::asset('img/forms/create.webp') }}" class="form-image" alt="">
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @isset($register)
        @if ($register == 'success')
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
@endsection