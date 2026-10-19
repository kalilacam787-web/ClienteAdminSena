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
                <label>
                    Aprendiz responsable
                    <select name="aprendiz_id">
                        <option value="">Selecciona un aprendiz</option>
                        @foreach ($apprentices as $apprentice)
                            <option value="{{ $apprentice->id }}" @selected(old('aprendiz_id') == $apprentice->id)>
                                {{ $apprentice->nombre }} {{ $apprentice->apellido1 }} {{ $apprentice->apellido2 }}
                            </option>
                        @endforeach
                    </select>
                    @if ($apprentices->isEmpty())
                        <a class="text-link" href="{{ route('aprendices') }}">Registrar primero un aprendiz</a>
                    @endif
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
                            <th>ID</th>
                            <th>Datos y acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($computers as $computer)
                            <tr>
                                <td>{{ $computer->id }}</td>
                                <td>
                                    <form class="entry-form" method="POST" action="{{ route('computadores.actualizar', $computer) }}">
                                        @csrf
                                        @method('PUT')
                                        <label>Código<input name="codigo" value="{{ $computer->codigo }}" required></label>
                                        <label>Marca<input name="marca" value="{{ $computer->marca }}" required></label>
                                        <label>Modelo<input name="modelo" value="{{ $computer->modelo }}" required></label>
                                        <label>Serial<input name="serial" value="{{ $computer->serial }}" required></label>
                                        <label>Estado
                                            <select name="estado" required>
                                                @foreach (['Operativo', 'En mantenimiento', 'Disponible', 'En revisión'] as $estado)
                                                    <option value="{{ $estado }}" @selected($computer->estado === $estado)>{{ $estado }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label>Sede
                                            <select name="sede" required>
                                                @foreach (['Popayán', 'Santander de Quilichao', 'Puerto Tejada'] as $sede)
                                                    <option value="{{ $sede }}" @selected($computer->sede === $sede)>{{ $sede }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label>Aprendiz responsable
                                            <select name="aprendiz_id">
                                                <option value="">Sin asignar</option>
                                                @foreach ($apprentices as $apprentice)
                                                    <option value="{{ $apprentice->id }}" @selected($computer->aprendiz_id == $apprentice->id)>
                                                        {{ $apprentice->nombre }} {{ $apprentice->apellido1 }} {{ $apprentice->apellido2 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <button type="submit" class="primary-button">Actualizar</button>
                                    </form>
                                    <form method="POST" action="{{ route('computadores.eliminar', $computer) }}" onsubmit="return confirm('¿Eliminar este computador?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-link">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2">Aún no hay computadores registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
