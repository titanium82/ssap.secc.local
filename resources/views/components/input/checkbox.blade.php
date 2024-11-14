<label class="form-check" style="--cat-depth: {{ $depth }}px">
    <input type="checkbox" {{ $attributes->class(['form-check-input']) }} {{ is_array($checked) ? $isCheckedIn($checked) : $isChecked($checked) }} value="{{ $value }}">
    <span class="form-check-label">{{ $label }}</span>
</label>