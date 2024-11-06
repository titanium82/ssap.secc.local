<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="unit" :value="$event_service_unit->unit" :required="true"
                        :placeholder="__('Unit')" />
                </div>
            </div>
        </div>
    </div>
</div>
