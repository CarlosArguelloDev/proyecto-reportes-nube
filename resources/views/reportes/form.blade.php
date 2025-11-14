
<div class="mb-3">
    <label>Usuario</label>
    <select name="usuario_id" class="form-control">
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" 
                {{ old('usuario_id', $reporte->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Título</label>
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $reporte->titulo ?? '') }}">
</div>

<div class="mb-3">
    <label>Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $reporte->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $reporte->direccion ?? '') }}">
</div>

<div class="mb-3">
    <label>Latitud</label>
    <input type="text" name="latitud" class="form-control" value="{{ old('latitud', $reporte->latitud ?? '') }}">
</div>

<div class="mb-3">
    <label>Longitud</label>
    <input type="text" name="longitud" class="form-control" value="{{ old('longitud', $reporte->longitud ?? '') }}">
</div>

<div class="mb-3">
    <label>Prioridad</label>
    <select name="prioridad_id" class="form-control">
        @foreach($prioridades as $p)
            <option value="{{ $p->id }}" 
                {{ old('prioridad_id', $reporte->prioridad_id ?? '') == $p->id ? 'selected' : '' }}>
                {{ $p->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado_id" class="form-control">
        @foreach($estados as $e)
            <option value="{{ $e->id }}" 
                {{ old('estado_id', $reporte->estado_id ?? '') == $e->id ? 'selected' : '' }}>
                {{ $e->nombre }}
            </option>
        @endforeach
    </select>
</div>
