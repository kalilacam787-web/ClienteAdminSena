@extends('layouts.adminsena')

@section('title', 'AdminSena | '.$title)

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">API ADMINSENA</p>
            <h1>{{ $title }}</h1>
            <p class="table-intro">Consulta de registros disponibles desde el servicio central.</p>
        </div>
        <span class="table-count"><strong>{{ $rows->count() }}</strong><span>registros</span></span>
    </section>

    <div class="api-table-layout">
        <aside class="api-table-nav panel-card">
            <div class="api-table-nav-heading">
                <p class="eyebrow">Explorar</p>
                <h2>Tablas disponibles</h2>
            </div>
            <nav class="api-table-links" aria-label="Tablas disponibles">
                @foreach (['areas' => 'Áreas', 'training-centers' => 'Centros', 'computers' => 'Computadores', 'courses' => 'Cursos', 'teachers' => 'Instructores', 'apprentices' => 'Aprendices', 'contacts' => 'Comentarios', 'galleries' => 'Galería'] as $resource => $label)
                    <a class="{{ $table === $resource ? 'is-active' : '' }}" href="{{ route('datos-api.show', $resource) }}">
                        <span>{{ $label }}</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <section class="api-table-content panel-card">
            @if ($error)
                <div class="table-state table-state-error">
                    <span class="table-state-icon" aria-hidden="true">!</span>
                    <div>
                        <h2>No fue posible cargar los registros</h2>
                        <p>{{ $error }}</p>
                    </div>
                </div>
            @elseif ($rows->isEmpty())
                <div class="table-state">
                    <span class="table-state-icon" aria-hidden="true">0</span>
                    <div>
                        <h2>Tabla sin registros</h2>
                        <p>Aún no hay información disponible en {{ strtolower($title) }}.</p>
                    </div>
                </div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                @foreach ($columns as $label)
                                    <th>{{ $label }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    @foreach ($columns as $field => $label)
                                        <td>{{ is_array($row[$field] ?? null) ? json_encode($row[$field]) : ($row[$field] ?? '—') }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection