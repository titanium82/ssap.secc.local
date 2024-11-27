<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Contract'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="contract_id" :required="true" :data-url="route('admin.contract.search_select')"></x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Period'):</label>
                    <x-core-input type="number" name="period" :value="old('period')" :required="true" :placeholder="trans('Ex: 1')"/>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Expired'):</label>
                    <x-core-input type="date" name="expired_at" :value="old('expired_at')" :required="true" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Amount'):</label>
                    <x-core-input class="input-format-number" name="amount" :value="old('amount')" :required="true" :placeholder="trans('Amount')"/>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <x-core-input-gallery-ckfinder name="license" :label="trans('Licenser')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('License Files'):</label>
                    <x-core-input-file-pond class="filepond-inline-2" name="license_files" :multiple="true" :maxFiles="6" style="opacity: 0" />
                </div>
            </div>
        </div>
    </div>
</div>
