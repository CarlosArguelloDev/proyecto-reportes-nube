@props([
  'name',
  'label' => null,
  'options' => [], // [value => text]
  'value' => null,
  'placeholder' => null,
  'required' => false,
  'disabled' => false,
])

<div class="mb-3">
  @if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
  @endif

  <select
    id="{{ $name }}"
    name="{{ $name }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}
  >
    @if($placeholder)
      <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($options as $k => $text)
      <option value="{{ $k }}" @selected(old($name, $value)==$k)>{{ $text }}</option>
    @endforeach
  </select>

  @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
