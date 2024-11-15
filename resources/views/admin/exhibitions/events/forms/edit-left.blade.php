<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="name" :value="$contract_type->name" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="short_name" :value="$contract_type->short_name" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
        </div>
    </div>
</div>