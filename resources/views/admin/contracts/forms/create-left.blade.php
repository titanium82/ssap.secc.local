<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Contract Type'):</label>
                    <x-core-select name="contract[contract_type_id]" onchange="loadShortNameCT(this)" :required="true">
                        @foreach ($contract_types as $contract_type)
                            <x-core-select-option :data-short-name="$contract_type->short_name" :value="$contract_type->id" :title="$contract_type->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition location'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="exhibition_location_id[]" :required="true" :multiple="true" :data-url="route('admin.exhibition_location.search_select')">
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Sector'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="sector_id[]" :required="true" :multiple="true" :data-url="route('admin.customer_sector.search_select')">
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Code Number'):</label>
                <div class="input-group">
                    <x-core-input name="contract[code]" :value="old('contract.code')" :required="true" data-parsley-errors-container="#errorCode" :placeholder="__('Code Number')" />
                    <span class="input-group-text">
                        <span>/</span>
                    </span>
                    <x-core-input name="contract_code_year" :value="old('contract_code_year')" :required="true" data-parsley-errors-container="#errorCode" :placeholder="__('Year')" />
                    <span class="input-group-text">
                        <span>-</span>
                        <span class="ct-short-name">HDDV</span>
                        <span>-{{ config('core.project_name') }}</span>
                    </span>
                </div>
                <div id="errorCode"></div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">@lang('Customer'):</label>
                    @adminaccessroutename('admin.customer.create')
                        <a href="{{ route('admin.customer.create') }}" target="_blank" class="mb-2">
                            <i class="icon ti ti-plus"></i>
                            @lang('Thêm mới')
                        </a>
                    @endadminaccessroutename
                    </div>
                    @if($customer)
                        <x-core-input name="contract[customer]" :value="$customer->fullname" disabled />
                        <x-core-input type="hidden" name="contract[customer_id]" :value="$customer->id" />
                    @else
                    <x-core-select class="select2-bs5-ajax-many" name="contract[customer_id]" :required="true" :data-url="route('admin.customer.search_select')">
                    </x-core-select>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Contract Exhibition Name'):</label>
                    <x-core-input name="contract[name]" :value="old('contract.name')" :required="true"
                        :placeholder="__('Contract Exhibition Name')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="contract[day_begin]" :value="old('contract.day_begin')" :required="true"
                        :placeholder="__('Day Begin')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day End'):</label>
                    <x-core-input type="date" name="contract[day_end]" :value="old('contract.day_end')" :required="true"
                        :placeholder="__('Day end')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Deposit'):</label>
                    <x-core-input class="input-format-number" name="contract[deposit]" :value="old('contract.deposit')" :required="true"
                        :placeholder="__('Deposit')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3" id="total">
                    <label class="form-label">@lang('Total Amount'):</label>
                    <x-core-input class="input-format-number" name="contract[total_amount]" :value="old('contract.total_amount')" :required="true"
                        :placeholder="__('Total Amount')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3" id="subtotal">
                    <label class="form-label">@lang('Sub Total Amount'):</label>
                    <x-core-input class="input-format-number" name="contract[sub_total_amount]" :value="old('contract.sub_total_amount')"
                        :placeholder="__('Sub Total Amount')" />
                </div>
                <div id="error_total" style="display:none; color: red; text-align:center;"></div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Currency'):</label>
                    <x-core-select name="contract[currency_id]" :required="true">
                        @foreach ($currencies as $currency)
                            <x-core-select-option :value="$currency->id" :title="$currency->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Payment method'):</label>
                    <x-core-select name="contract[payment_method]" :required="true">
                        @foreach ($payment_methods as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Note'):</label>
                    <textarea class="form-control" name="contract[note]">{{ old('contract.note') }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Files'):</label>
                <x-core-input-file-pond class="filepond-inline-2" name="contract[files][]" :multiple="true" :maxFiles="6" style="opacity: 0" />
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Annex'):</label>
                <x-core-input-file-pond class="filepond-inline-2" name="contract[annex][]" :multiple="true" :maxFiles="6" style="opacity: 0" />
            </div>
        </div>
    </div>
</div>
