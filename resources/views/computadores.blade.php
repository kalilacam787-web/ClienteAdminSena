@extends('layouts.adminsena')

@section('title', 'AdminSena | Computadores')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Inventario</p>
            <h1>Registro de computadores</h1>
        </div>
    </section>

    <div class="panel-grid two-columns">
        <section class="panel-card form-card">
            <h2>Nuevo registro</h2>
            @if (session('success'))
                <p class="status-pill ok">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <p class="status-pill alert">{{ $errors->first() }}</p>
            @endif
            <form class="entry-form" method="POST" action="{{ route('computadores.guardar') }}">
                @csrf
                <label>
                    Código del equipo
                    <input type="text" name="codigo" value="{{ old('codigo') }}" placeholder="Ingrese el código" required>
                </label>
                <label>
                    Marca
                    <input type="text" name="marca" value="{{ old('marca') }}" placeholder="Marca" required>
                </label>
                <label>
                    Modelo
                    <input type="text" name="modelo" value="{{ old('modelo') }}" placeholder="Modelo" required>
                </label>
                <label>
                    Serial
                    <input type="text" name="serial" value="{{ old('serial') }}" placeholder="Serial" required>
                </label>
                <label>
                    Estado
                    <select name="estado" required>
                        <option value="">Selecciona un estado</option>
                        <option @selected(old('estado') === 'Operativo')>Operativo</option>
                        <option @selected(old('estado') === 'En mantenimiento')>En mantenimiento</option>
                        <option @selected(old('estado') === 'Disponible')>Disponible</option>
                        <option @selected(old('estado') === 'En revisión')>En revisión</option>
                    </select>
                </label>
                <label>
                    Sede
                    <select name="sede" required>
                        <option value="">Selecciona una sede</option>
                        <option @selected(old('sede') === 'Popayán')>Popayán</option>
                        <option @selected(old('sede') === 'Santander de Quilichao')>Santander de Quilichao</option>
                        <option @selected(old('sede') === 'Puerto Tejada')>Puerto Tejada</option>
                    </select>
                </label>
                <button type="submit" class="primary-button">Guardar computador</button>
            </form>
        </section>

        <section class="panel-card">
            <div class="section-title-row">
                <h2>Listado</h2>
                <span class="muted-badge">{{ $computers->count() }} equipos</span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($computers as $computer)
                            <tr>
                                <td>{{ $computer->codigo }}</td>
                                <td>{{ $computer->marca }}</td>
                                <td>{{ $computer->modelo }}</td>
                                <td><span class="status-pill {{ $computer->estado === 'Operativo' ? 'ok' : ($computer->estado === 'Disponible' ? 'warn' : 'alert') }}">{{ $computer->estado }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Aún no hay computadores registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
