@extends('layouts.app')
@section('title', 'Editar Reporte #'.$reporte->id)

@push('styles')
  {{-- Leaflet CSS --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <style>
    #mapa { min-height: 400px; border-radius: .5rem; }
    .img-preview { max-height: 160px; border-radius:.5rem; }
  </style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Editar Reporte #{{ $reporte->id }}</h1>
  <a href="{{route('reportes.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<form action="{{ route('reportes.update', $reporte) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="row g-4">
    {{-- Columna izquierda: datos --}}
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">

          <div class="mb-3">
            <label class="form-label">Título *</label>
            <input type="text" name="titulo"
                   class="form-control @error('titulo') is-invalid @enderror"
                   value="{{ old('titulo', $reporte->titulo) }}">
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="4" class="form-control">{{ old('descripcion', $reporte->descripcion) }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control"
                   value="{{ old('direccion', $reporte->direccion) }}">
          </div>

          {{-- Foto actual + nueva --}}
          <div class="mb-3">
            <label class="form-label">Fotografía</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

            <div class="form-text">Si subes una nueva, reemplaza a la actual.</div>

            <div class="mt-2">
              <img src="{{ asset('storage/reportes/'.$reporte->id.'.jpg') }}"
                   class="img-preview"
                   onerror="this.src='{{ asset('images/no-image.jpg') }}'">
            </div>
          </div>

          <hr>

          <div class="mb-3">
            <input type="hidden" name="latitud" id="latitud" readonly class="form-control"
                   value="{{ old('latitud', $reporte->latitud) }}">
          </div>

          <div class="mb-3">
            <input type="hidden" name="longitud" id="longitud" readonly class="form-control"
                   value="{{ old('longitud', $reporte->longitud) }}">
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
            Haz clic en el mapa o arrastra el marcador para ajustar la ubicación.
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

  // Si el reporte ya tiene coords, centramos ahí; si no, CDMX (por ejemplo)
  const hasCoords = {{ $reporte->latitud && $reporte->longitud ? 'true' : 'false' }};
  const startLat  = hasCoords ? {{ $reporte->latitud  ?? '19.4326' }} : 19.4326;
  const startLng  = hasCoords ? {{ $reporte->longitud ?? '-99.1332' }} : -99.1332;
  const startZoom = hasCoords ? 16 : 13;

  const map = L.map('mapa').setView([startLat, startLng], startZoom);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19, attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  let marker = null;

  function setPoint(lat, lng) {
    latInput.value = Number(lat).toFixed(7);
    lngInput.value = Number(lng).toFixed(7);

    if (!marker) {
      marker = L.marker([lat, lng], { draggable: true }).addTo(map);
      marker.on('dragend', (ev) => {
        const { lat, lng } = ev.target.getLatLng();
        setPoint(lat, lng);
      });
    } else {
      marker.setLatLng([lat, lng]);
    }
  }

  // Si ya tiene coordenadas, coloca el marcador
  if (hasCoords) setPoint(startLat, startLng);

  // Click en el mapa para colocar/mover marcador
  map.on('click', function(e) {
    setPoint(e.latlng.lat, e.latlng.lng);
  });
});
</script>
@endpush
