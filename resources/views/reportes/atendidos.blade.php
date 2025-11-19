@extends('layouts.app')
@section('title', 'Reportes Atendidos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Reportes Atendidos</h1>

</div>

@if($reportes->isEmpty())
  <div class="alert alert-info">
    No hay reportes atendidos aún.
  </div>
@else
  @foreach($reportes as $r)
    <div class="card overflow-hidden mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{ asset('storage/reportes/'.$r->id.'.jpg') }}"
               class="img-fluid"
               alt="reporte"
               onerror="this.src='{{ asset('images/no-image.jpg') }}'">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title mb-2">
              {{ $r->titulo }}
              <x-badge.estado :id="$r->estado_id" class="ms-2" />
              <x-badge.prioridad :id="$r->prioridad_id" class="ms-2" />
            </h5>
            <p class="card-text">{{ $r->descripcion ?? 'Sin descripción' }}</p>
            <div class="text-muted small mb-2">
              <i class="ti ti-calendar-event"></i> {{ $r->created_at->format('d/m/Y H:i') }}
              @if($r->direccion)
                · <i class="ti ti-map-pin"></i> {{ $r->direccion }}
              @endif
            </div>
            <br><br>
            <x-bform.bbutton text="Ver más" :href="route('reportes.show',$r)" color="primary" icon="ti ti-eye" outline size="sm" />
          </div>
        </div>
      </div>
    </div>
  @endforeach
  <div class="mt-3">{{ $reportes->links() }}</div>
@endif
@endsection
