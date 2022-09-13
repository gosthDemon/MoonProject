<nav class="nav" id="nav">
    <ul class="list">
        <li class="list__item">
            <div class="list__button">
                <i class="far fa-tachometer-alt @if($isOpen== 'admin/home'){{ 'active-button' }} @endif"></i>
                <a href="#" class="nav__link @if($isOpen== 'admin/home'){{ 'active-button' }} @endif" >&nbsp;Home</a>
            </div>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="far fa-user-md"></i>
                <a href="#" class="nav__link">&nbsp; Medicos</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="{{ route('medico/showForm') }}" class="nav__link nav__link--inside  @if($isOpen== 'medico/showForm'){{ 'active-button' }} @endif ">Nuevo Médico</a>
                </li>
                <li class="list__inside">
                    <a href="{{ route('medico/showAll') }}" class="nav__link nav__link--inside @if($isOpen== 'medico/showAll'){{ 'active-button' }} @endif">Médicos</a>
                </li>
            </ul>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="far fa-hospital-user"></i>
                <a href="#" class="nav__link">Centros Médicos</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="{{ route('centro medico/showForm') }}" class="nav__link nav__link--inside @if($isOpen== 'centro medico/showForm'){{ 'active-button' }} @endif">Nuevo Céntro</a>
                </li>
                <li class="list__inside">
                    <a href="{{ route('centro medico/showAll') }}" class="nav__link nav__link--inside @if($isOpen== 'centro medico/showAll'){{ 'active-button' }} @endif">Centros Médicos</a>
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
                    <a href="{{ route('paciente/showForm') }}" class="nav__link nav__link--inside @if($isOpen== 'paciente/showForm'){{ 'active-button' }} @endif">Nuevo Paciente</a>
                </li>
                <li class="list__inside">
                    <a href="{{ route('paciente/showAll') }}" class="nav__link nav__link--inside @if($isOpen== 'paciente/showAll'){{ 'active-button' }} @endif">Pacientes</a>
                </li>
            </ul>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="far fa-cog @if($isOpen== 'admin/Home'){{ 'active-button' }}@endif "></i>
                <a href="#" class="nav__link @if($isOpen== 'admin/Home'){{ 'active-button' }}@endif ">&nbsp;Configuracion</a>
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