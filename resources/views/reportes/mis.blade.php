@extends('layouts.app')
@section('title','Mis reportes')
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Desactiva toggles de dropdown que no tengan .dropdown-menu
  document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function (el) {
    const hasMenu = el.closest('.dropdown')?.querySelector('.dropdown-menu');
    if (!hasMenu) el.removeAttribute('data-bs-toggle');
  });

  // Evita que otros listeners de fila intercepten los clicks de acciones
  document.querySelectorAll('table .btn, table form button').forEach(function(el){
    el.addEventListener('click', function(e){ e.stopPropagation(); }, true);
  });
});
</script>

@endpush
@section('content')
<h5 class="mb-3">Mis reportes</h5>
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif


<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-borderless align-middle">
        <thead>
          <tr>
            <th style="width:80px;">ID</th>
            <th>Título</th>
            <th style="width:160px;">TAGS</th>
            <th style="width:160px;">Fecha</th>
            <th style="width:240px;" class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($reportes as $r)
          <tr>
            <td>#{{ $r->id }}</td>

            <td class="text-truncate" style="max-width: 320px;">
                {{ $r->titulo }}
              @if($r->direccion)
                <div class="text-muted small">{{ $r->direccion }}</div>
              @endif
            </td>

            <td>
              <span class="badge bg-{{ config('ui.estados')[$r->estado_id]['color'] ?? 'secondary' }}">
                @if(config('ui.estados')[$r->estado_id]['icon'] ?? null)
                  <i class="{{ config('ui.estados')[$r->estado_id]['icon'] }}"></i>
                @endif
                {{ config('ui.estados')[$r->estado_id]['label'] ?? 'Estado' }}
              </span>

              <span class="badge bg-{{ config('ui.prioridades')[$r->prioridad_id]['color'] ?? 'secondary' }}">
                @if(config('ui.prioridades')[$r->prioridad_id]['icon'] ?? null)
                  <i class="{{ config('ui.prioridades')[$r->prioridad_id]['icon'] }}"></i>
                @endif
                {{ config('ui.prioridades')[$r->prioridad_id]['label'] ?? 'Prioridad' }}
              </span>
            </td>

            <td class="text-nowrap">
              {{ optional($r->created_at)->format('d/m/Y H:i') }}
            </td>

            <td class="text-end" style="position:relative; z-index:2;">
              <a href="{{ route('reportes.show',$r) }}" class="btn btn-sm btn-outline-secondary">
                <i class="ti ti-eye"></i> Ver
              </a>
              <a href="{{ route('reportes.edit',$r) }}" class="btn btn-sm btn-outline-warning">
                <i class="ti ti-edit"></i> Editar
              </a>
              <form action="{{ route('reportes.destroy',$r) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('¿Eliminar reporte #{{ $r->id }}?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  <i class="ti ti-trash"></i> Eliminar
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">No tienes reportes aún.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pt-3">
      {{ $reportes->withQueryString()->links() }}
    </div>
  </div>
</div>
@endsection
