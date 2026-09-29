@extends('layouts.adminsena')

@section('title', 'AdminSena | Comentarios')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">COMUNIDAD SENA</p>
            <h1>Comentarios recibidos</h1>
        </div>
        <span class="muted-badge">{{ $comments->count() }} mensajes</span>
    </section>

    <section class="panel-card">
        @if ($apiError)
            <p class="status-pill alert">No fue posible conectar con la API de comentarios. Verifica que el servicio esté activo.</p>
        @elseif ($comments->isEmpty())
            <p>Aún no hay comentarios registrados en la API.</p>
        @else
            <div class="cards-stack">
                @foreach ($comments as $comment)
                    <article class="mini-card">
                        <div class="role-head">
                            <strong>{{ $comment['name'] ?? 'Usuario' }}</strong>
                            <span class="status-pill {{ ($comment['status'] ?? '') === 'resolved' ? 'ok' : 'warn' }}">
                                {{ ($comment['status'] ?? '') === 'resolved' ? 'Respondido' : 'Pendiente' }}
                            </span>
                        </div>
                        <p>{{ $comment['message'] ?? 'Sin comentario' }}</p>
                        <div class="meta-row">
                            <span>{{ $comment['email'] ?? '' }}</span>
                            @if (!empty($comment['created_at']))
                                <time datetime="{{ $comment['created_at'] }}">{{ \Illuminate\Support\Carbon::parse($comment['created_at'])->format('d/m/Y H:i') }}</time>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection