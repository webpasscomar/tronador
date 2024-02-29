<!-- NAV / menú -->
<header class="sticky-md-top border-top border-5 border-primary">
    <nav class="container-fluid navbar navbar-expand-lg bg-white py-0 menutop shadow">
        <div class="container-md">
            <a class="navbar-brand col-6 col-md-3 col-lg-3" href="{{ route('home') }}" title="Inicio del Monitor">
                <!-- logo -->
                <img src="{{ asset('img/logo.png') }}" alt="Monitor de Sequía" class="img-fluid float-left">
                <h1 class="visually-hidden"> Monitor de Sequía</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIS('mesa') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Página principal" class="nav-link">Mesa nacional del
                            monitor<span class="visually-hidden">(Mesa)</span></a>
                    </li>
                    <li class="nav-item {{ request()->routeIS('proceso') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Nuestros servicios" class="nav-link">Proceso de trabajo</a>
                    </li>


                    <li class="nav-item {{ request()->routeIS('referencias') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Nuestras actividades" class="nav-link">Referencias</a>
                    </li>

                    <li class="nav-item dropdown {{ request()->routeIS('indices') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Indices
                        </a>
                        <div class="dropdown-menu bg-light mt-1 shadow-sm" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">Indice 1</a>
                            <a class="dropdown-item" href="#">Indice 2</a>
                            <a class="dropdown-item" href="#">Indice 3</a>
                            <a class="dropdown-item" href="#">Indice 4</a>
                            <a class="dropdown-item" href="#">Indice 5</a>
                            <a class="dropdown-item" href="#">Indice 6</a>
                            <a class="dropdown-item" href="#">Indice 7</a>
                        </div>
                    </li>

                    <!-- contacto -->
                    <li class="nav-item {{ request()->routeIS('contacto') ? 'active' : '' }}">
                        <a href="{{ route('contacto') }}" title="Contactanos" class="nav-link">Contacto</a>
                    </li>
                    <!-- buscador -->
                    <li class="nav-item search">
                        <form>
                            <div class="animated-search m-md-0 mb-sm-4">
                                <input type="search" id="animated-input">
                                <a href="#">
                                    <i class="fas fa-search" id="searchBtn"></i>
                                </a>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            </li>

            </ul>
        </div>
        </div>
    </nav>
</header>
