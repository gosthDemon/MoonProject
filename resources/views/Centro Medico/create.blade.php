@extends('layouts.GeneralTemplate')

@section('tittle')
    Nuevo Centro Médico
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
    <style>
        @media screen and (max-width: 991px) {
            #container-image{
                display: none;
            }
        }
        .card-body{
            padding: 0px;
        }
        .container-image{
        background-color: #E1ECFE;
        padding:0px
        }
        .form-image{
        height: 350px !important;
        }
        .datos{
            padding: 30px
        }
    </style>
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
            <span class="page">/ Nuevo Centro Médico</span>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            Nuevo Centro Médico
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 container-image" id="container-image">
                <img src="{{ URL::asset('img/forms/createMedicalCenter.webp') }}" class="form-image" alt="">
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 datos">
                <form action="/centro medico/create" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"  value="{{ old('nombre') }}" >
                        
                        <small id="nombreText" class="form-text alert text-muted">@if ($errors->has('nombre'))
                            <i class="far fa-bar"></i>{{ $errors->first('nombre') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Ej: Mi_Correo_Electronico@medicina.com"  value="{{ old('email') }}" >
                        {{ csrf_field() }}
                        <small id="emailText" class="form-text alert text-muted">@if ($errors->has('email'))
                            <i class="far fa-bar"></i>{{ $errors->first('email') }}
                        @else
                            <span style="color: green">Formato recomendado: Mi_Correo_Electronico@medicina.com</span>
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="nivel">Nivel del Centro:</label>
                        <select class="form-control" id="nivel" name="nivel" value="{{ old('nivel') }}">
                            <option value=""></option>
                                <option value="Hospital"  {{ old('nivel') == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                                <option value="Posta Medica"  {{ old('nivel') == 'Posta Medica' ? 'selected' : '' }}>Posta Médica</option>
                        </select>
                        {{ csrf_field() }}
                        <small id="nivelText" class="form-text alert text-muted">@if ($errors->has('nivel'))
                            <i class="far fa-bar"></i>{{ $errors->first('nivel') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono"  value="{{ old('telefono') }}">
                        {{ csrf_field() }}
                        <small id="telefonoText" class="form-text alert text-muted">@if ($errors->has('telefono'))
                            <i class="far fa-bar"></i>{{ $errors->first('telefono') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"  value="{{ old('direccion') }}">
                        {{ csrf_field() }}
                        <small id="direccionText" class="form-text alert text-muted">@if ($errors->has('direccion'))
                            <i class="far fa-bar"></i>{{ $errors->first('direccion') }}
                        @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña por defecto:</label>
                        <input type="text" class="form-control" id="password" name="passwrod" disabled placeholder="0000"  value="{{ old('password') }}">
                        {{ csrf_field() }}
                        <small id="passwordText" class="form-text alert text-muted">
                            <span style="color: black">La contraseña podra ser cambiada al ingresar al perfil creado.</span>
                        </small>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="button btn-submit"><i class="fad fa-save"></i> Guardar</button>
                        <button type="reset" class="button btn-cancel"><i class="fad fa-trash"></i> Cancelar</button>
                    </div>
                </form>

            </div>
            
        
    </div>
    <div class="card-footer">
            
        </div>
@endsection

@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@isset($register)

<script>
    
</script>
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
<script>
    
</script>
    
@endsection