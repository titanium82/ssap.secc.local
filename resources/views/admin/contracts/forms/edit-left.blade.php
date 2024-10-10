<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Contract Type'):</label>
                    <x-core-input name="contract[contract_type]" :value="$contract->type?->name" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Sector'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="sector_id[]" :required="true" :multiple="true" :data-url="route('admin.customer_sector.search_select')">
                        @foreach ($contract->sectors as $sector)
                            <x-core-select-option :option="$sector->id" :value="$sector->id" :title="$sector->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Customer'):</label>
                    <x-core-input name="contract[customer]" :value="$contract->customer?->fullname" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition location'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="exhibition_location_id[]" :required="true" :multiple="true" :data-url="route('admin.exhibition_location.search_select')">
                        @foreach ($contract->exhibitionLocations as $exhibition_location)
                            <x-core-select-option :option="$exhibition_location->id" :value="$exhibition_location->id" :title="$exhibition_location->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Code'):</label>
                    <x-core-input name="contract[code]" :value="$contract->code" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="contract[name]" :value="$contract->name" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="contract[day_begin]" :value="$contract->day_begin->format('Y-m-d')" readonly :required="true"
                        :placeholder="__('Day Begin')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Day end'):</label>
                    <x-core-input type="date" name="contract[day_end]" :value="$contract->day_end->format('Y-m-d')" readonly :required="true"
                        :placeholder="__('Day end')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Currency'):</label>
                    <x-core-input name="contract[currency]" :value="$contract->currency?->name" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Payment method'):</label>
                    <x-core-select name="contract[payment_method]" :required="true">
                        @foreach ($payment_methods as $key => $value)
                            <x-core-select-option :option="$contract->payment_method->value" :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Deposit'):</label>
                    <x-core-input class="input-format-number" name="contract[deposit]" :value="number_format($contract->deposit)" readonly :required="true"
                        :placeholder="__('Deposit')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Total Amount'):</label>
                    <x-core-input class="input-format-number" name="contract[total_amount]" :value="number_format($contract->total_amount)" readonly :required="true"
                        :placeholder="__('Total Amount')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Sub Total Amount'):</label>
                    <x-core-input class="input-format-number" name="contract[sub_total_amount]" :value="number_format($contract->sub_total_amount)"
                        :placeholder="__('Sub Total Amount')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Note'):</label>
                    <textarea class="form-control" name="contract[note]">{{ $contract->note }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Files'):</label>
                <x-core-input-file-pond name="contract[files][]" :value="$contract->files?->toArray()" style="opacity: 0" />
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Annex'):</label>
                <x-core-input-file-pond name="contract[annex][]" :value="$contract->annex?->toArray()" style="opacity: 0" />
            </div>
        </div>
    </div>
</div>
