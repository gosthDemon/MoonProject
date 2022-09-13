<nav class="nav" id="nav">
    <ul class="list">
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-tachometer-alt"></i>
                <a href="#" class="nav__link">Inicio</a>
            </div>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="fas fa-file-alt"></i>
                <a href="#" class="nav__link">Servicios</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
            </ul>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="fas fa-file-alt"></i>
                <a href="#" class="nav__link">Servicios</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
            </ul>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="fas fa-file-alt"></i>
                <a href="#" class="nav__link">Servicios</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside active-button">Estoy dentro</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
            </ul>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-analytics"></i>
                <a href="#" class="nav__link">Estadisticas</a>
            </div>
        </li>
        <li class="list__item list__item--click open">
            <div class="list__button list__button--click">
                <i class="fas fa-bell"></i>
                <a href="#" class="nav__link">Notificaciones</a>
                <img src="{{ URL::asset('img/main/arrow.svg') }}" class="list__arrow">
            </div>
            <ul class="list__show">
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
                <li class="list__inside">
                    <a href="#" class="nav__link nav__link--inside">Estoy dentro</a>
                </li>
            </ul>
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