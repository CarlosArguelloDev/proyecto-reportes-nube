@props([
  'text',
  'href' => null,        
  'color' => 'primary',  
  'icon' => null,        
  'type' => 'button',    
  'outline' => false,
  'size' => null,        
])

@php
  $colors = config('ui.button_colors');
  $base   = config('ui.button_base', 'btn');
  $classColor = $colors[$color] ?? $colors['primary'];
  if ($outline) $classColor = str_replace('btn-', 'btn-outline-', $classColor);
  $sizeClass = $size ? 'btn-'.$size : '';
  $classes = trim("$base $classColor $sizeClass");
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->class($classes) }}>
    @if($icon)<i class="{{ $icon }}"></i>@endif
    <span>{{ $text }}</span>
  </a>
@else
  <button type="{{ $type }}" {{ $attributes->class($classes) }}>
    @if($icon)<i class="{{ $icon }}"></i>@endif
    <span>{{ $text }}</span>
  </button>
@endif
