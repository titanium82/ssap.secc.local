<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 mb-3">
                <label class="form-label">@lang('Event Service Type'):</label>
                <x-core-select name="event_service_type_id" :required="true">
                    @foreach ($types as $type)
                        <x-core-select-option :value="$type->id" :title="$type->name" />
                    @endforeach
                </x-core-select>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Unit'):</label>
                    <x-core-select name="unit" :required="true">
                        @foreach ($unit as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                     <label class="form-label">@lang('Desc'):</label>
                     <x-core-input name="desc" :value="old('desc')"
                        :placeholder="__('Desc')" />
                </div>
            </div>
        </div>
    </div>
</div>
