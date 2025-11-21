@extends('layouts.app')
@section('title', 'Zonas')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
  .zona-mapa { min-height: 360px; border-radius: .5rem; }
  .leaflet-popup-content img { max-width: 180px; border-radius: .25rem; }
  .legend { background:#fff; padding:.5rem .75rem; border-radius:.5rem; box-shadow:0 1px 3px rgba(0,0,0,.1); }
  .legend .dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:.4rem; vertical-align:middle; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Zonas</h1>
  <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>


  @foreach($zonas as $i => $z)
    <div class="col-12 col-lg-12">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong>{{ $z['title'] }}</strong>
        </div>
        <div class="card-body p-2">
          <div id="map-{{ $i }}" class="zona-mapa"></div>
        </div>
      </div>
    </div>
  @endforeach

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const zonas    = @json($zonas);
  const reportes = @json($reportes);


  const prioridadColors = {
    1: '#6c757d', // Baja -> secondary
    2: '#0dcaf0', // Media -> info
    3: '#dc3545', // Alta -> danger
    4: '#b02a37', // Crítica -> dark-danger
  };

  zonas.forEach((z, idx) => {
    const map = L.map('map-' + idx, { scrollWheelZoom: false })
      .setView([z.lat, z.lng], z.zoom ?? 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19, attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const group = L.featureGroup().addTo(map);

    reportes.forEach(r => {
      const color = prioridadColors[r.prioridad_id] || '#0d6efd';

      const marker = L.circleMarker([r.lat, r.lng], {
        radius: 7,
        weight: 1,
        color: '#333',
        fillColor: color,
        fillOpacity: 0.9
      }).addTo(map);

      const imgTag = `<img src="${r.img}" onerror="this.src='{{ asset('images/no-image.jpg') }}'" alt="rep-${r.id}">`;
      const info   = `
        <div style="min-width:220px">
          <strong>#${r.id} - ${r.titulo}</strong><br>
          <small>${r.fecha}${r.direccion ? ' · '+r.direccion : ''}</small>
          <div class="mt-2">${imgTag}</div>
          <div class="mt-2">
            <a class="btn btn-primary" href="${r.url}">Ver más</a>
          </div>
        </div>
      `;

      marker.bindPopup(info);
      group.addLayer(marker);
    });

   

    // Leyenda por prioridad (opcional)
    const legend = L.control({position:'bottomleft'});
    legend.onAdd = function() {
      const div = L.DomUtil.create('div','legend');
      div.innerHTML = `
        <div class="mb-1"><strong>Prioridad</strong></div>
        <div><span class="dot" style="background:${prioridadColors[1]}"></span> Baja</div>
        <div><span class="dot" style="background:${prioridadColors[2]}"></span> Media</div>
        <div><span class="dot" style="background:${prioridadColors[3]}"></span> Alta</div>
        <div><span class="dot" style="background:${prioridadColors[4]}"></span> Crítica</div>
      `;
      return div;
    };
    legend.addTo(map);
  });
});
</script>
@endpush
