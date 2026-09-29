@extends('layouts.adminsena')

@section('title', 'AdminSena | Ofertas')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Formación</p>
            <h1>Ofertas educativas</h1>
        </div>
    </section>

    <div class="panel-grid two-columns">
        <section class="panel-card form-card">
            <h2>Nueva oferta</h2>
            @if (session('success'))
                <p class="status-pill ok">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <p class="status-pill alert">{{ $errors->first() }}</p>
            @endif
            <form class="entry-form" method="POST" action="{{ route('ofertas.guardar') }}">
                @csrf
                <label>
                    Nombre del programa
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Programa" required>
                </label>
                <label>
                    Modalidad
                    <select name="modalidad" required>
                        <option value="">Selecciona una modalidad</option>
                        <option @selected(old('modalidad') === 'Virtual')>Virtual</option>
                        <option @selected(old('modalidad') === 'Presencial')>Presencial</option>
                        <option @selected(old('modalidad') === 'Mixto')>Mixto</option>
                        <option @selected(old('modalidad') === 'Dual')>Dual</option>
                        <option @selected(old('modalidad') === 'Híbrida')>Híbrida</option>
                    </select>
                </label>
                <label>
                    Duración
                    <input type="text" name="duracion" value="{{ old('duracion') }}" placeholder="Ej. 12 meses" required>
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
                <button type="submit" class="primary-button">Guardar oferta</button>
            </form>
        </section>

        <section class="panel-card">
            <div class="section-title-row">
                <h2>Programas vigentes</h2>
                <span class="muted-badge">{{ $offers->count() }} programas</span>
            </div>

            <div class="cards-stack">
                @forelse ($offers as $offer)
                    <article class="mini-card">
                        <strong>{{ $offer->nombre }}</strong>
                        <div class="meta-row">
                            <span>{{ $offer->modalidad }}</span>
                            <span>{{ $offer->duracion }}</span>
                        </div>
                        <small>{{ $offer->centro }}</small>
                    </article>
                @empty
                    <p>Aún no hay ofertas registradas.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
