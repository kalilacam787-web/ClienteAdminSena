<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#050705">
    <title>AdminSena | Formación que transforma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="site">
        <header class="topbar">
            <a class="brand" href="#inicio" aria-label="AdminSena, inicio">
                <span class="brand-mark">S</span>
                <span>Admin<span class="brand-light">Sena</span></span>
            </a>
            <nav class="main-nav" aria-label="Navegación principal">
                <a href="#inicio">Inicio</a>
                <a href="#oferta">Formación</a>
                <a href="#servicios">Gestión</a>
                <a href="#nosotros">Nosotros</a>
            </nav>
            <a class="button-outline" href="{{ route('computadores') }}">Portal de gestión</a>
        </header>

        <main>
            <section class="hero" id="inicio">
                <div class="hero-copy">
                    <span class="eyebrow">PLATAFORMA DE GESTIÓN</span>
                    <h1>Formación que abre <em>nuevos</em> caminos.</h1>
                    <p>Administra programas, aprendices, computadores y recursos de los centros de formación SENA del Cauca desde un solo lugar.</p>
                    <a class="button-primary" href="#oferta">Explorar programas <span aria-hidden="true">→</span></a>
                    <div class="hero-note"><span class="status-dot"></span> Servicio Nacional de Aprendizaje</div>
                    <div class="hero-stats" aria-label="Indicadores de la plataforma">
                        <div class="stat-card">
                            <strong>06</strong>
                            <span>Áreas clave</span>
                        </div>
                        <div class="stat-card">
                            <strong>+120</strong>
                            <span>Registros</span>
                        </div>
                        <div class="stat-card">
                            <strong>3</strong>
                            <span>Departamentos</span>
                        </div>
                    </div>
                </div>

                <div class="hero-media" aria-label="Panel visual del SENA">
                    <div class="hero-board">
                        <img src="{{ asset('images/formacion-sena.jpeg') }}" alt="Estudiantes aprendiendo juntos">
                        <div class="hero-board-overlay"></div>
                        <span class="math math-1">π</span>
                        <span class="math math-2">45</span>
                        <span class="math math-3">x²</span>
                        <span class="math math-4">E=mc²</span>
                        <span class="math math-5">Σ</span>
                        <div class="hero-board-text">
                            <span class="board-line board-line-1">APRENDE Y ESTUDIA</span>
                            <span class="board-line board-line-2">CON NOSOTROS</span>
                        </div>
                    </div>
                    <div class="hero-badge">
                        <strong>01</strong>
                        <span>Formación<br>para el futuro</span>
                    </div>
                </div>
            </section>

            <section class="section services" id="servicios">
                <div class="section-heading">
                    <div>
                        <span class="eyebrow">TODO EN UN MISMO LUGAR</span>
                        <h2>Gestión simple,<br><em>impacto real.</em></h2>
                    </div>
                    <p>Herramientas para acompañar cada proceso formativo con claridad, control y actualización constante.</p>
                </div>

                <div class="feature-grid" id="oferta">
                    <a class="feature" href="{{ route('ofertas') }}">
                        <div class="feature-thumb thumb-1"></div>
                        <span class="feature-number">01</span>
                        <h3>Ofertas educativas</h3>
                        <p>Consulta y registra programas, niveles y modalidades de formación.</p>
                        <span class="feature-link">Programas de formación <span aria-hidden="true">↗</span></span>
                    </a>
                    <a class="feature" href="{{ route('computadores') }}">
                        <div class="feature-thumb thumb-2"></div>
                        <span class="feature-number">02</span>
                        <h3>Computadores</h3>
                        <p>Controla inventario, estados y disponibilidad en cada centro del Cauca.</p>
                        <span class="feature-link">Inventario de equipos <span aria-hidden="true">↗</span></span>
                    </a>
                    <a class="feature" href="{{ route('aprendices') }}">
                        <div class="feature-thumb thumb-3"></div>
                        <span class="feature-number">03</span>
                        <h3>Aprendices</h3>
                        <p>Registra aprendices, ficha, programas y estados de formación.</p>
                        <span class="feature-link">Comunidad SENA <span aria-hidden="true">↗</span></span>
                    </a>
                    <a class="feature" href="{{ route('roles') }}">
                        <div class="feature-thumb thumb-4"></div>
                        <span class="feature-number">04</span>
                        <h3>Roles</h3>
                        <p>Actualiza permisos y perfiles de usuarios según su responsabilidad.</p>
                        <span class="feature-link">Administración de usuarios <span aria-hidden="true">↗</span></span>
                    </a>
                    <a class="feature" href="{{ route('centros') }}">
                        <div class="feature-thumb thumb-5"></div>
                        <span class="feature-number">05</span>
                        <h3>Centros del Cauca</h3>
                        <p>Consulta sedes reales, direcciones y coordenadas de formación regional.</p>
                        <span class="feature-link">Ubicación de sedes <span aria-hidden="true">↗</span></span>
                    </a>
                    <a class="feature" href="{{ route('comentarios') }}">
                        <div class="feature-thumb thumb-6"></div>
                        <span class="feature-number">06</span>
                        <h3>Comentarios</h3>
                        <p>Consulta los mensajes enviados por la comunidad SENA.</p>
                        <span class="feature-link">Mensajes recibidos <span aria-hidden="true">↗</span></span>
                    </a>
                </div>
            </section>

            <section class="about-section" id="nosotros">
                <img src="{{ asset('images/centro-sena.webp') }}" alt="Espacio de formación SENA">
                <div class="about-copy">
                    <span class="eyebrow">SERVICIO NACIONAL DE APRENDIZAJE</span>
                    <h2>Aprender transforma<br><em>el futuro.</em></h2>
                    <p>En el departamento del Cauca, la formación conecta talento, educación y oportunidades para fortalecer comunidades y proyectos con impacto real.</p>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div><strong>Servicio Nacional de Aprendizaje SENA</strong><span>Formación que transforma vidas</span></div>
            <div class="footer-meta">
                <span>Popayán · Santander de Quilichao · Puerto Tejada</span>
                <span>© {{ date('Y') }} AdminSena</span>
            </div>
        </footer>
    </div>
</body>
</html>
