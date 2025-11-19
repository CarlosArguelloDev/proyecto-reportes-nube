@props([
  'id' => null,     // prioridad_id
  'text' => null,   // Texto
])

@php
  $conf = config('ui.prioridades')[$id ?? 0] ?? null;
  $label = $text ?? ($conf['label'] ?? 'Prioridad');
  $color = $conf['color'] ?? 'secondary';
  $icon  = $conf['icon']  ?? null;
@endphp

<span {{ $attributes->class(['badge','bg-'.$color]) }}>
  @if($icon)<i class="{{ $icon }}"></i>@endif
  {{ $label }}
</span>
