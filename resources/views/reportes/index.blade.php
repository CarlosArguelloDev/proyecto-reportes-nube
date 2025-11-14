@extends('layouts.app')

@section('title', 'Reportes')

@section('content')

<a href="{{ route('reportes.create') }}" class="btn btn-primary d-inline-flex">
    <i class="ti ti-plus"></i> Realizar reporte
</a>
<br><br>

@foreach ($reportes as $r)
    <div class="card overflow-hidden mb-3">
        <div class="row g-0">

            {{-- Imagen --}}
            <div class="col-md-4">
                <img
                    src="{{ asset('storage/reportes/'.$r->id.'.jpg') }}"
                    alt="Imagen Reporte {{ $r->id }}"
                    class="img-fluid"
                    width="256"
                    onerror="this.src='{{ asset('images/no-image.jpg') }}'"
                >
            </div>

            {{-- Contenido --}}
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title">
                        {{ $r->titulo }}

                        @if (!empty($r->diametro))
                            <span class="badge bg-light-warning">
                                <i class="ti ti-ruler-2"></i>
                                Diámetro: {{ $r->diametro }}cm
                            </span>
                        @endif

                        <span class="badge bg-info">
                            <i class="ti ti-clock"></i>
                            Estado: {{ $r->estado->nombre ?? 'N/A' }}
                        </span>

                        <span class="badge bg-danger">
                            <i class="ti ti-arrow-up-right"></i>
                            Prioridad: {{ $r->prioridad->nombre ?? 'N/A' }}
                        </span>
                    </h5>

                    @if (!empty($r->descripcion))
                        <p class="card-text">{{ $r->descripcion }}</p>
                    @endif

                    <p class="card-text">
                        <i class="ti ti-calendar-event"></i>
                        <small class="text-muted">{{ $r->created_at->format('m/d/Y') }}</small>

                        @if (!empty($r->direccion))
                            <i class="ti ti-map-pin ms-2"></i>
                            <small class="text-muted">{{ $r->direccion }}</small>
                        @endif
                        <br><br>

                        <a href="{{ route('reportes.show', $r->id) }}" class="card-link">Ver Más</a>
                        <a href="{{ route('reportes.show', $r->id) }}#comentarios" class="card-link">Comentarios</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
