@props([
  'name',
  'label' => null,
  'rows' => 3,
  'placeholder' => null,
  'required' => false,
  'disabled' => false,
])

<div class="mb-3">
  @if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
  @endif

  <textarea
    id="{{ $name }}"
    name="{{ $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
  >{{ old($name) }}</textarea>

  @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
