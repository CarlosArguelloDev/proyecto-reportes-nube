@extends('layouts.app')
@section('title', 'Reportes')

@section('content')
<a href="{{ route('reportes.create') }}" class="btn btn-primary d-inline-flex">
    <i class="ti ti-plus"></i> Realizar reporte
</a>
<br><br>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@foreach ($reportes as $r)
  @php
    $collapseId = 'comentarios-'.$r->id;
    $shouldOpen = session('open_comments') == $r->id || ($errors->any() && old('reporte_id') == $r->id);
  @endphp

  <div class="card overflow-hidden mb-3">
    <div class="row g-0">
      <div class="col-md-4">
        <img
          src="{{ asset('storage/reportes/'.$r->id.'.jpg') }}"
          alt="Imagen Reporte {{ $r->id }}"
          class="img-fluid"
          width="256"
          
        >
      </div>

      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">
            {{ $r->titulo }}

            @if (!empty($r->diametro))
              <span class="badge bg-light-warning">
                <i class="ti ti-ruler-2"></i> Diámetro: {{ $r->diametro }}cm
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
            <small class="text-muted">{{ optional($r->created_at)->format('m/d/Y') }}</small>

            @if (!empty($r->direccion))
              <i class="ti ti-map-pin ms-2"></i>
              <small class="text-muted">{{ $r->direccion }}</small>
            @endif
          </p>

          {{-- Botón para abrir comentarios --}}
          <a class="card-link" data-bs-toggle="collapse" href="#{{ $collapseId }}" role="button"
             aria-expanded="{{ $shouldOpen ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
            Comentarios ({{ $r->comentarios->count() }})
          </a>
          <a href="{{ route('reportes.show', $r->id) }}" class="card-link">Ver más</a>
        </div>
      </div>
    </div>

    {{-- Sección colapsable de comentarios --}}
    <div class="collapse {{ $shouldOpen ? 'show' : '' }}" id="{{ $collapseId }}">
      <div class="card-body border-top">

        {{-- Lista de comentarios --}}
        @forelse($r->comentarios as $c)
          <div class="d-flex align-items-start mb-3">
            <div class="me-2">
              <span class="badge bg-secondary">{{ $c->usuario->nombre ?? 'Usuario #'.$c->usuario_id }}</span>
            </div>
            <div class="flex-grow-1">
              <div class="small text-muted">
                {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y H:i') }}
                @if(!$c->publico) <span class="badge bg-dark">Privado</span> @endif
              </div>
              <div>{{ $c->texto }}</div>
            </div>
            {{-- Opcional: borrar (si aplica permisos) --}}
            {{-- <form action="{{ route('comentarios.destroy', $c) }}" method="POST" class="ms-2">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar comentario?')">
                <i class="ti ti-trash"></i>
              </button>
            </form> --}}
          </div>
        @empty
          <p class="text-muted">Aún no hay comentarios.</p>
        @endforelse

        <hr>

        {{-- Formulario para comentar --}}
        <form action="{{ route('reportes.comentarios.store', $r) }}" method="POST">
          @csrf
          <input type="hidden" name="reporte_id" value="{{ $r->id }}">

          @if (!auth()->check())
            {{-- Si no usas auth de Laravel, pedimos usuario_id (o puedes cambiar por un select) --}}
            <div class="mb-2">
              <label class="form-label">Usuario ID</label>
              <input type="number" name="usuario_id"
                     value="{{ old('usuario_id') }}"
                     class="form-control @error('usuario_id') is-invalid @enderror"
                     placeholder="Ej: 1">
              @error('usuario_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          @endif

          <div class="mb-2">
            <label class="form-label">Comentario</label>
            <textarea name="texto" rows="3"
                      class="form-control @error('texto') is-invalid @enderror"
                      placeholder="Escribe tu comentario...">{{ old('texto') }}</textarea>
            @error('texto') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="publico" value="1" id="pub-{{ $r->id }}" checked>
            <label class="form-check-label" for="pub-{{ $r->id }}">Público</label>
          </div>

          <button class="btn btn-sm btn-primary">
            <i class="ti ti-send"></i> Comentar
          </button>
        </form>

      </div>
    </div>
  </div>
@endforeach

{{ $reportes->links() }}
@endsection
