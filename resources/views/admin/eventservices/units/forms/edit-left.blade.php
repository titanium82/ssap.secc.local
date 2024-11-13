<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Service Type'):</label>
                    <x-core-input name="contract[eventservice_type]" :value="$event_service_unit->type?->name" readonly />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input  name="name" :value="$event_service_unit->name" readonly />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Unit'):</label>
                    <x-core-select name="contract[payment_method]" :required="true">
                        @foreach ($unit as $key => $value)
                            <x-core-select-option :option="$event_service_unit->unit->value" :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Width'):</label>
                    <x-core-input  name="width" :value="$event_service_unit->width" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Height'):</label>
                    <x-core-input name="height" :value="$event_service_unit->height" />
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Sound System'):</label>
                    <x-core-input  name="sound_system" :value="$event_service_unit->sound_system" />
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Wireless Micro'):</label>
                    <x-core-input  name="wireless_micro" :value="$event_service_unit->wireless_micro" />
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Backdrop'):</label>
                    <x-core-input  name="backdrop" :value="$event_service_unit->backdrop" />
                </div>
            </div>
        </div>
    </div>
</div>
