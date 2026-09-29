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
                    Nombre completo
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre completo" required>
                </label>
                <label>
                    Programa
                    <input type="text" name="programa" value="{{ old('programa') }}" placeholder="Programa" required>
                </label>
                <label>
                    Ficha
                    <input type="text" name="ficha" value="{{ old('ficha') }}" placeholder="Ficha" required>
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
                            <th>Nombre</th>
                            <th>Programa</th>
                            <th>Ficha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apprentices as $apprentice)
                            <tr>
                                <td>{{ $apprentice->nombre }}</td>
                                <td>{{ $apprentice->programa }}</td>
                                <td>{{ $apprentice->ficha }}</td>
                                <td><span class="status-pill {{ $apprentice->estado === 'Activo' ? 'ok' : 'warn' }}">{{ $apprentice->estado }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Aún no hay aprendices registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
