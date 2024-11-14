<label class="form-check form-switch">
    <input type="checkbox" {{ $attributes->class(['form-check-input']) }} {{ is_array($checked) ? $isCheckedIn($checked) : $isChecked($checked) }} value="{{ $value }}">
    <span class="form-check-label">
        @if ($linkLabel)
            <a href="{{ asset($value) }}" target="_blank">{{ $label }}</a>
        @else
            {{ $label }}
        @endif
    </span>
</label>
