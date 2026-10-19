@extends('layouts.adminsena')

@section('title', 'AdminSena | Roles')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Seguridad</p>
            <h1>Actualización de roles</h1>
        </div>
    </section>

    <div class="panel-grid full-width">
        <section class="panel-card">
            @if (session('success'))
                <p class="status-pill ok">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <p class="status-pill alert">{{ $errors->first() }}</p>
            @endif
            <div class="section-title-row">
                <h2>Roles del sistema</h2>
                <span class="muted-badge">{{ $roles->count() }} perfiles</span>
            </div>

            <form class="entry-form" method="POST" action="{{ route('roles.guardar') }}">
                @csrf
                <label>Nombre del rol<input type="text" name="nombre" value="{{ old('nombre') }}" required></label>
                <label>Usuario asociado<input type="text" name="usuario" value="{{ old('usuario') }}" required></label>
                <label>Permisos<input type="text" name="permisos" value="{{ old('permisos') }}" required></label>
                <label>Estado
                    <select name="estado" required>
                        <option value="Activo" @selected(old('estado') === 'Activo')>Activo</option>
                        <option value="En revisión" @selected(old('estado') === 'En revisión')>En revisión</option>
                        <option value="Inactivo" @selected(old('estado') === 'Inactivo')>Inactivo</option>
                    </select>
                </label>
                <button type="submit" class="primary-button">Crear rol</button>
            </form>

            <div class="cards-stack">
                @forelse ($roles as $role)
                    <article class="mini-card">
                        <form class="entry-form" method="POST" action="{{ route('roles.actualizar', $role) }}">
                            @csrf
                            @method('PUT')
                            <div class="role-head">
                                <strong>{{ $role->nombre }}</strong>
                                <span class="status-pill {{ $role->estado === 'Activo' ? 'ok' : 'warn' }}">{{ $role->estado }}</span>
                            </div>
                            <label>
                                Nombre del rol
                                <input type="text" name="nombre" value="{{ $role->nombre }}" required>
                            </label>
                            <label>
                                Usuario asociado
                                <input type="text" name="usuario" value="{{ $role->usuario }}" required>
                            </label>
                            <label>
                                Permisos
                                <input type="text" name="permisos" value="{{ $role->permisos }}" required>
                            </label>
                            <label>
                                Estado
                                <select name="estado" required>
                                    <option value="Activo" @selected($role->estado === 'Activo')>Activo</option>
                                    <option value="En revisión" @selected($role->estado === 'En revisión')>En revisión</option>
                                    <option value="Inactivo" @selected($role->estado === 'Inactivo')>Inactivo</option>
                                </select>
                            </label>
                            <button type="submit" class="primary-button">Guardar cambios</button>
                        </form>
                        <form method="POST" action="{{ route('roles.eliminar', $role) }}" onsubmit="return confirm('¿Eliminar este rol?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-link">Eliminar</button>
                        </form>
                    </article>
                @empty
                    <p>Aún no hay roles registrados.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
