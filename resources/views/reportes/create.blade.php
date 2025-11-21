@extends('layouts.app')

@section('title', 'Crear Reporte')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <style>
    #mapa { min-height: 400px; border-radius: .5rem; }
  </style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Nuevo Reporte</h1>
  <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<form action="{{ route('reportes.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row g-4">
    {{-- Columna izquierda: datos --}}
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">

          <div class="mb-3">
            <label class="form-label">Título *</label>
            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
                   value="{{ old('titulo') }}">
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="4" class="form-control">{{ old('descripcion') }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Fotografía</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <hr>
          <div class="mb-3">
            <input type="hidden" name="latitud" id="latitud" readonly class="form-control" value="{{ old('latitud') }}">
          </div>

          <div class="mb-3">
            <input type="hidden" name="longitud" id="longitud" readonly class="form-control" value="{{ old('longitud') }}">
          </div>

          

        </div>
      </div>
    </div>

    {{-- Columna derecha: mapa --}}
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><strong>Ubicación en el mapa</strong></div>
        <div class="card-body p-2">
          <div id="mapa"></div>
          <p class="text-muted small mt-2">
            Haz clic en el mapa para seleccionar la ubicación del reporte.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="text-end">
            <button class="btn btn-primary">
              <i class="ti ti-send"></i> Guardar Reporte
            </button>
          </div>
</form>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const latInput = document.getElementById('latitud');
  const lngInput = document.getElementById('longitud');

  const map = L.map('mapa').setView([20.398989, -99.9731976], 13); // SJR
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  let marker;

  map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    latInput.value = lat.toFixed(7);
    lngInput.value = lng.toFixed(7);

    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
  });
});
</script>
@endpush
