

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/fontAwesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    @yield('css')
</head>
<body id="body">
    <header>
        <div class="icon__menu btn-open">
            <i class="far fa-bars"></i>
        </div>
        <a href="#" class="a-header">Home</a>
        <a href="#" class="a-header"> Contact</a>
        <input type="text" class="header-search" id="searchInput" placeholder="Search..."><button class="search-i" id="searchButton"><i class="far fa-search"></i></button>
    </header>
    <div class="main-container" id="main_container">
        <i class="far fa-bars close-icon btn-open"></i>
        @if ($user_data->role == "Admin")
            @include('components.menu_admin')
        @elseif($user_data->role == "SubAdmin")
            @include('components.menu_SubAdmin')
        @elseif($user_data->role == "Medico")
            @include('components.menu_medico')
        @elseif($user_data->role == "Paciente")
            @include('components.menu_Paciente')
        @endif
    </div>

    @yield('content')
    
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script> 
        window.onload = UserData;
        function UserData(){
            const http = new XMLHttpRequest();
            const url = "/general/userData";
            http.onreadystatechange = function(){
                if (this.readyState==4 && this.status == 200) {
                    let UserData = JSON.parse(this.responseText);
                    document.getElementById('role').innerHTML = UserData.role;
                    
                }
            }
            http.open('GET', url);
            http.send();
            
        }
    </script>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
