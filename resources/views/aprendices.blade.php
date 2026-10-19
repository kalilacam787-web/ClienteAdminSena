@extends('layouts.adminsena')

@section('title', 'AdminSena | Aprendices')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Comunidad</p>
            <h1>Registro de aprendices</h1>
        </div>
    </section>

    <div class="panel-grid two-columns">
        <section class="panel-card form-card">
            <h2>Nuevo aprendiz</h2>
            @if (session('success'))
                <p class="status-pill ok">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <p class="status-pill alert">{{ $errors->first() }}</p>
            @endif
            <form class="entry-form" method="POST" action="{{ route('aprendices.guardar') }}">
                @csrf
                <label>
                    Nombre(s)
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre(s)" required>
                </label>
                <label>
                    Primer apellido
                    <input type="text" name="apellido1" value="{{ old('apellido1') }}" placeholder="Primer apellido" required>
                </label>
                <label>
                    Segundo apellido
                    <input type="text" name="apellido2" value="{{ old('apellido2') }}" placeholder="Segundo apellido" required>
                </label>
                <label>
                    Número de cédula
                    <input type="text" name="cedula" value="{{ old('cedula') }}" inputmode="numeric" placeholder="Número de cédula" required>
                </label>
                <label>
                    Curso
                    <input type="text" name="programa" value="{{ old('programa') }}" placeholder="Curso o programa" required>
                </label>
                <label>
                    Número de ficha
                    <input type="text" name="ficha" value="{{ old('ficha') }}" placeholder="Número de ficha" required>
                </label>
                <label>
                    Centro de formación
                    <select name="centro" required>
                        <option value="">Selecciona un centro</option>
                        <option @selected(old('centro') === 'Popayán')>Popayán</option>
                        <option @selected(old('centro') === 'Santander de Quilichao')>Santander de Quilichao</option>
                        <option @selected(old('centro') === 'Puerto Tejada')>Puerto Tejada</option>
                    </select>
                </label>
                <label>
                    Estado
                    <select name="estado" required>
                        <option value="">Selecciona un estado</option>
                        <option @selected(old('estado') === 'Activo')>Activo</option>
                        <option @selected(old('estado') === 'En prórroga')>En prórroga</option>
                        <option @selected(old('estado') === 'Formación')>Formación</option>
                        <option @selected(old('estado') === 'Finalizado')>Finalizado</option>
                    </select>
                </label>
                <button type="submit" class="primary-button">Guardar aprendiz</button>
            </form>
        </section>

        <section class="panel-card">
            <div class="section-title-row">
                <h2>Aprendices registrados</h2>
                <span class="muted-badge">{{ $apprentices->count() }} registros</span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Datos y acciones del aprendiz</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apprentices as $apprentice)
                            <tr>
                                <td>
                                    <form class="entry-form" method="POST" action="{{ route('aprendices.actualizar', $apprentice) }}">
                                        @csrf
                                        @method('PUT')
                                        <label>Nombre(s)<input name="nombre" value="{{ $apprentice->nombre }}" required></label>
                                        <label>Primer apellido<input name="apellido1" value="{{ $apprentice->apellido1 }}" required></label>
                                        <label>Segundo apellido<input name="apellido2" value="{{ $apprentice->apellido2 }}" required></label>
                                        <label>Cédula<input name="cedula" value="{{ $apprentice->cedula }}" required></label>
                                        <label>Curso<input name="programa" value="{{ $apprentice->programa }}" required></label>
                                        <label>Ficha<input name="ficha" value="{{ $apprentice->ficha }}" required></label>
                                        <label>Centro
                                            <select name="centro" required>
                                                @foreach (['Popayán', 'Santander de Quilichao', 'Puerto Tejada'] as $centro)
                                                    <option value="{{ $centro }}" @selected($apprentice->centro === $centro)>{{ $centro }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label>Estado
                                            <select name="estado" required>
                                                @foreach (['Activo', 'En prórroga', 'Formación', 'Finalizado'] as $estado)
                                                    <option value="{{ $estado }}" @selected($apprentice->estado === $estado)>{{ $estado }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <button type="submit" class="primary-button">Actualizar</button>
                                    </form>
                                    <form method="POST" action="{{ route('aprendices.eliminar', $apprentice) }}" onsubmit="return confirm('¿Eliminar este aprendiz? Los computadores asociados quedarán sin asignar.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-link">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td>Aún no hay aprendices registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
