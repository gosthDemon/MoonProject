<nav class="nav" id="nav">
    <ul class="list">
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-tachometer-alt"></i>
                <a href="#" class="nav__link">&nbsp;Home</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-file-medical-alt"></i>
                <a href="#" class="nav__link">&nbsp;Reservar Cita</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-books-medical"></i>
                <a href="#" class="nav__link">Mis Citas</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button">
                <i class="fas fa-cog"></i>
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