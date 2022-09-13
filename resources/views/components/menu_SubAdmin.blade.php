<nav class="nav" id="nav">
    <ul class="list">
        <li class="list__item">
            <div class="list__button">
                <i class="far fa-tachometer-alt"></i>
                <a href="#" class="nav__link">&nbsp;Home</a>
            </div>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="far fa-user-md"></i>
                <a href="#" class="nav__link">&nbsp; Ficha Médica</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Nuevo Ficha</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Liberar Fichas</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Fichas Reservadas</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Fichas Admitidas</a>
                </li>
            </ul>
            
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="far fa-user-md"></i>
                <a href="#" class="nav__link">&nbsp; Medicos</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Nuevo Médico</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Médicos</a>
                </li>
            </ul>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="far fa-users"></i>
                <a href="#" class="nav__link"> Pacientes</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside active-button">Nuevo Paciente</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Pacientes</a>
                </li>
            </ul>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="far fa-cog"></i>
                <a href="#" class="nav__link">&nbsp;Configuracion</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button">
                <form  method="POST" action="{{ route('logout') }}" style="display: inline-block">
                @csrf
                <a :href="route('logout')" onclick="this.closest('form').submit();" class="nav__link"><i class="far fa-toggle-on"></i> &nbsp;&nbsp; Salir</a>
                </form>
            </div>
        </li>
    </ul>
</nav>