<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 mb-3">
                <label class="form-label">@lang('Electrical Equipment Type'):</label>
                <x-core-select name="electrical_equipment_type_id" :required="true">
                    @foreach ($types as $type)
                        <x-core-select-option :value="$type->id" :title="$type->name" />
                    @endforeach
                </x-core-select>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Electrical Equipment Name'):</label>
                    <x-core-input name="name" :value="old('name')" :required="true"
                        :placeholder="__('Electrical Equipment Name')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Electrical Equipment Short Name'):</label>
                    <x-core-input name="shortname" :value="old('shortname')" :required="true"
                        :placeholder="__('Electrical Equipment Short Name')" />
                </div>
            </div>
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
                    <label class="form-label">@lang('Cost'):</label>
                    <x-core-input class="input-format-number" name="cost" :value="old('cost')" :required="true"
                        :placeholder="__('Cost')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Price'):</label>
                    <x-core-input class="input-format-number" name="price" :value="old('price')" :required="true"
                        :placeholder="__('Price')" />
                </div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">@lang('Warehouse'):</label>
                <x-core-select name="warehouse_id" :required="true">
                    @foreach ($warehouses as $warehouse)
                        <x-core-select-option :value="$warehouse->id" :title="$warehouse->name" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Desc'):</label>
                    <x-core-input name="desc" :value="old('desc')" :required="true"
                        :placeholder="__('Desc')" />
                </div>
            </div>
        </div>
    </div>
</div>
