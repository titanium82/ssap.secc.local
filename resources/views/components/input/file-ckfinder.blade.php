<div class="wrap-ckfinder-multiple">
    <label class="form-label">{{ $label }}:</label>
    <input type="text" {{ $attributes->class(['form-control d-none'])->merge($isRequired()) }}
        name="{{ $name }}" value="{{ $marcoValue($value) }}" readonly="{{ $readonly }}">
    <div id="{{ $preview }}" class="row">
        @if ($value)
            @foreach ($value as $item)
                <div class="col-md-4 col-6 mt-3 mb-3">
                    @if (!$readonly)
                        <span class="delete-image-ckfinder" data-url="{{ $item }}" data-route="0">
                            <i class="ti ti-x"></i>
                        </span>
                    @endif
                    <img src="{{ $urlFeature($item) }}" width="100%">

                    <div class="text-center"><a href="{{ asset($item) }}" target="_blank">{{ basename($item) }}</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if (!$readonly)
        <button class="btn btn-outline-secondary add-files-ckfinder" type="button" data-preview="#{{ $preview }}"
            data-input="input[name='{{ $name }}']"
            @if ($multiple) data-type="MULTIPLE" @endif>
            {{ $btntext }}
        </button>
    @endif
</div>
