@extends('layouts.adminsena')

@section('title', 'AdminSena | Centros')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Ubicación</p>
            <h1>Centros de formación del Cauca</h1>
        </div>
        <a href="#" class="primary-button">Ver mapa</a>
    </section>

    <div class="panel-grid full-width">
        <section class="panel-card">
            <div class="section-title-row">
                <h2>Ubicaciones reales</h2>
                <span class="muted-badge">{{ count($centers) }} sedes</span>
            </div>

            <div class="centers-grid">
                @foreach ($centers as $center)
                    <article class="center-card">
                        <strong>{{ $center['nombre'] }}</strong>
                        <p>{{ $center['municipio'] }}</p>
                        <ul>
                            <li>{{ $center['direccion'] }}</li>
                            <li>{{ $center['telefono'] }}</li>
                            <li>Lat: {{ $center['latitud'] }} / Lon: {{ $center['longitud'] }}</li>
                        </ul>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection
