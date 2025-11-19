@extends('layouts.app')

@section('title', 'Reporte #'.$reporte->id)

@push('styles')
  {{-- Leaflet --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <style>
    #mapa { min-height: 360px; border-radius: .5rem; }
    .img-cover { width:100%; height:360px; object-fit:cover; border-radius:.5rem; }
  </style>
@endpush



@section('content')
{{-- Si se actualiza --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="ti ti-checks me-1"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">{{ $reporte->titulo }}
      <x-badge.estado :id="$reporte->estado_id" class="ms-2"/>
    <x-badge.prioridad :id="$reporte->prioridad_id" class="ms-2"/>
    </h1>
  <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary">
    ← Volver
  </a>
</div>

{{-- Imagen + Mapa  --}}
<div class="row g-3">
  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header">
        <strong>Foto del bache</strong>
      </div>
      <div class="card-body p-2">
    <img
      src="{{ asset('storage/reportes/'.$reporte->id.'.jpg') }}"
      alt="Imagen Reporte {{ $reporte->id }}"
      class="img-cover"
    >
      </div>
    </div>
    
  </div>

  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header">
        <strong>Ubicación</strong>
      </div>
      <div class="card-body p-2">
        @if($reporte->latitud && $reporte->longitud)
          <div id="mapa"></div>
        @else
          <div class="alert alert-warning mb-0">
            Este reporte no tiene coordenadas (lat/long).
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- Abajo: info del reporte --}}
<div class="card mt-4">
    <div class="card-header">
        <strong>Información del Reporte</strong>
      </div>
  <div class="card-body">
    

    @if($reporte->descripcion)
      <p class="mb-2">{{ $reporte->descripcion }}</p>
    @endif


      <span class="ms-3"><i class="ti ti-user"></i> Reportado por: {{ $reporte->usuario->nombre ?? 'Usuario #'.$reporte->usuario_id }}</span><br>
      <span class="ms-3"><i class="ti ti-calendar-event"></i> {{ optional($reporte->created_at)->format('d/m/Y H:i') }}</span><br>
      <span class="ms-3"><i class="ti ti-map-pin"></i> {{ $reporte->direccion }}</span><br>
      <span class="ms-3"><i class="ti ti-location"></i> {{ $reporte->latitud }}, {{ $reporte->longitud }}</span>

  </div>
</div>

{{-- Comentarios --}}
<div id="comentarios" class="card mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Comentarios ({{ $reporte->comentarios->count() }})</strong>
    <a href="#form-comentario" class="btn btn-sm btn-primary">Agregar comentario</a>
  </div>

  <div class="card-body">
    @forelse($reporte->comentarios as $c)
      <div class="d-flex align-items-start mb-3">
        <div class="me-2">
          <span class="badge bg-secondary">{{ $c->usuario->nombre ?? 'Usuario #'.$c->usuario_id }}</span>
        </div>
        <div class="flex-grow-1">
          <div class="small text-muted">
            {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}
            @if(!$c->publico) <span class="badge bg-dark ms-2">Privado</span> @endif
          </div>
          <div>{{ $c->texto }}</div>
        </div>
      </div>
      <hr>
    @empty
      <p class="text-muted mb-0">Aún no hay comentarios.</p>
    @endforelse
  </div>
</div>

{{-- Formulario de comentario --}}
<div class="card mt-3" id="form-comentario">
  <div class="card-body">
    <form action="{{ route('reportes.comentarios.store', $reporte) }}" method="POST">
      @csrf

      @if (!auth()->check())
        <div class="mb-3">
          <label class="form-label">Usuario ID</label>
          <input type="number" name="usuario_id"
                 value="{{ old('usuario_id') }}"
                 class="form-control @error('usuario_id') is-invalid @enderror"
                 placeholder="Ej: 1">
          @error('usuario_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      @endif

      <div class="mb-3">
        <label class="form-label">Comentario</label>
        <textarea name="texto" rows="3"
                  class="form-control @error('texto') is-invalid @enderror"
                  placeholder="Escribe tu comentario...">{{ old('texto') }}</textarea>
        @error('texto') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="publico" value="1" id="pub" checked>
        <label class="form-check-label" for="pub">Público</label>
      </div>

      <button class="btn btn-primary">
        <i class="ti ti-send"></i> Comentar
      </button>
    </form>
  </div>
</div>
@endsection

@push('scripts')
  {{-- Leaflet JS --}}
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  @if($reporte->latitud && $reporte->longitud)
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var lat = {{ $reporte->latitud }};
      var lng = {{ $reporte->longitud }};

      var map = L.map('mapa', { scrollWheelZoom: false }).setView([lat, lng], 16);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
      }).addTo(map);

      L.marker([lat, lng]).addTo(map)
        .bindPopup(`{{ addslashes($reporte->titulo) }}`)
        .openPopup();
    });
  </script>
  @endif
@endpush
