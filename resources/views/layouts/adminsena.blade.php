<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0a3817">
    <title>@yield('title', 'AdminSena')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-body">
    <a class="skip-link" href="#contenido">Saltar al contenido</a>
    <div class="layout-shell">
        <header class="main-header">
            <div class="brand-box">
                <span class="brand-mark">S</span>
                <div>
                    <span class="brand-title">Admin<span class="brand-accent">Sena</span></span>
                    <small>Departamento del Cauca</small>
                </div>
            </div>

            <nav class="main-nav" aria-label="Navegación principal">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" @if (request()->routeIs('home')) aria-current="page" @endif>Inicio</a>
                <a href="{{ route('computadores') }}" class="nav-link {{ request()->routeIs('computadores') ? 'active' : '' }}" @if (request()->routeIs('computadores')) aria-current="page" @endif>Computadores</a>
                <a href="{{ route('aprendices') }}" class="nav-link {{ request()->routeIs('aprendices') ? 'active' : '' }}" @if (request()->routeIs('aprendices')) aria-current="page" @endif>Aprendices</a>
                <a href="{{ route('ofertas') }}" class="nav-link {{ request()->routeIs('ofertas') ? 'active' : '' }}" @if (request()->routeIs('ofertas')) aria-current="page" @endif>Ofertas</a>
                <a href="{{ route('roles') }}" class="nav-link {{ request()->routeIs('roles') ? 'active' : '' }}" @if (request()->routeIs('roles')) aria-current="page" @endif>Roles</a>
                <a href="{{ route('centros') }}" class="nav-link {{ request()->routeIs('centros') ? 'active' : '' }}" @if (request()->routeIs('centros')) aria-current="page" @endif>Centros</a>
                <a href="{{ route('comentarios') }}" class="nav-link {{ request()->routeIs('comentarios') ? 'active' : '' }}" @if (request()->routeIs('comentarios')) aria-current="page" @endif>Comentarios</a>
                <a href="{{ route('datos-api.show', 'areas') }}" class="nav-link {{ request()->routeIs('datos-api.*') ? 'active' : '' }}" @if (request()->routeIs('datos-api.*')) aria-current="page" @endif>Tablas API</a>
            </nav>

            <a href="{{ route('home') }}" class="header-button">Volver al inicio</a>
        </header>

        <div class="content-wrapper">
            <main class="page-main" id="contenido" tabindex="-1">
                @yield('content')
            </main>
        </div>

        <footer class="site-footer">
            <div class="footer-brand">
                <strong>Servicio Nacional de Aprendizaje</strong>
                <span>Regional Cauca</span>
            </div>

            <div class="footer-grid">
                <div>
                    <strong>Dirección</strong>
                    <p>Cra. 5 # 4-80, Popayán, Cauca</p>
                </div>
                <div>
                    <strong>Contacto</strong>
                    <p>contacto@sena.edu.co<br>+57 602 823 8300</p>
                </div>
                <div>
                    <strong>Horario</strong>
                    <p>Lunes a viernes<br>7:30 a.m. - 5:00 p.m.</p>
                </div>
            </div>

            <span class="footer-copy">© {{ date('Y') }} AdminSena</span>
        </footer>
    </div>
</body>
</html>
