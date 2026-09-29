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
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('computadores') }}" class="nav-link {{ request()->routeIs('computadores') ? 'active' : '' }}">Computadores</a>
                <a href="{{ route('aprendices') }}" class="nav-link {{ request()->routeIs('aprendices') ? 'active' : '' }}">Aprendices</a>
                <a href="{{ route('ofertas') }}" class="nav-link {{ request()->routeIs('ofertas') ? 'active' : '' }}">Ofertas</a>
                <a href="{{ route('roles') }}" class="nav-link {{ request()->routeIs('roles') ? 'active' : '' }}">Roles</a>
                <a href="{{ route('centros') }}" class="nav-link {{ request()->routeIs('centros') ? 'active' : '' }}">Centros</a>
                <a href="{{ route('comentarios') }}" class="nav-link {{ request()->routeIs('comentarios') ? 'active' : '' }}">Comentarios</a>
                <a href="{{ route('datos-api.show', 'areas') }}" class="nav-link {{ request()->routeIs('datos-api.*') ? 'active' : '' }}">Tablas API</a>
            </nav>

            <a href="#" class="header-button">Portal SENA</a>
        </header>

        <div class="content-wrapper">
            <aside class="sidebar">
                <div class="side-card">
                    <p class="eyebrow">Acceso rápido</p>
                    <ul class="side-list">
                        <li><a href="{{ route('computadores') }}">Registrar computador</a></li>
                        <li><a href="{{ route('aprendices') }}">Registrar aprendiz</a></li>
                        <li><a href="{{ route('ofertas') }}">Agregar oferta</a></li>
                        <li><a href="{{ route('roles') }}">Actualizar roles</a></li>
                        <li><a href="{{ route('centros') }}">Ubicaciones</a></li>
                        <li><a href="{{ route('comentarios') }}">Ver comentarios</a></li>
                        <li><a href="{{ route('datos-api.show', 'areas') }}">Consultar tablas API</a></li>
                    </ul>
                </div>

                <div class="side-card warning-card">
                    <p class="eyebrow">Cauca</p>
                    <strong>Gestión regional</strong>
                    <span>Popayán, Santander de Quilichao y Puerto Tejada</span>
                </div>
            </aside>

            <main class="page-main">
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
