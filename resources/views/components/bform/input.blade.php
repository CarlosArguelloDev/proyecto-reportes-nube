@props([
  'name',
  'label' => null,
  'type' => 'text',
  'value' => null,
  'placeholder' => null,
  'required' => false,
  'disabled' => false,
])

<div class="mb-3">
  @if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
  @endif

  <input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
  >

  @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
