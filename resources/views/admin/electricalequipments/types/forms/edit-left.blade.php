<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="name" :value="$electrical_equipment_type->name" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
        </div>
    </div>
</div>
