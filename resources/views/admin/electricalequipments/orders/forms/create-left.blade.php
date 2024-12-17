<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition Event'):</label>
                    <x-core-select name="electricalequipment[exhibition_event_id]" :required="true">
                        @foreach ($exhibitionevents as $exhibitionevent)
                            <x-core-select-option :data-short-name="$exhibitionevent->short_name" :value="$exhibitionevent->id" :title="$exhibitionevent->short_name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-5">
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
                        <x-core-input name="electricalequipment[customer]" :value="$customer->fullname" disabled />
                        <x-core-input type="hidden" name="electricalequipment[customer_id]" :value="$customer->id" />
                    @else
                    <x-core-select class="select2-bs5-ajax-many" name="electricalequipment[customer_id]" :required="true" :data-url="route('admin.customer.search_select')">
                    </x-core-select>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Customer Type'):</label>
                    <x-core-select name="electricalequipment[customer_type_id]" onchange="loadShortNameCT(this)" :required="true">
                        @foreach ($customertypes as $customertype)
                            <x-core-select-option :data-short-name="$customertype->short_name" :value="$customertype->id" :title="$customertype->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition location'):</label>
                    <x-core-select name="electricalequipment[exhibition_location_id]" :required="true">
                        @foreach ($exhibitionlocations as $exhibitionlocation)
                            <x-core-select-option :data-short-name="$exhibitionlocation->fullname" :value="$exhibitionlocation->id" :title="$exhibitionlocation->fullname" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <!-- code -->
            <div class="col-12 col-md-3">
                <label class="form-label">@lang('Electrical Equipment Code'):</label>
                <div class="input-group">
                    <x-core-input name="electricalequipment[code]" :value="old('electricalequipment.code')" :required="true" data-parsley-errors-container="#errorCode" :placeholder="__('Electrical Equipment Code')" />
                    <span class="input-group-text">
                        <span>/</span>
                    </span>
                    <x-core-input name="electricalequipment_code_year" :value="old('electricalequipment_code_year')" :required="true" data-parsley-errors-container="#errorCode" :placeholder="__('Year')" />
                    <span class="input-group-text">
                        <span>-{{ config('core.electrical_team') }}</span>
                        <span>-</span>
                        <span class="ct-short-name">BTC</span>
                        <span>-{{ config('core.project_name') }}</span>
                    </span>
                </div>
                <div id="errorCode"></div>
            </div>
            <div class="col-12 col-md-1">
                <div class="mb-3">
                    <label class="form-label">@lang('Booth No'):</label>
                    <x-core-input name="electricalequipment[booth_no]" :value="old('electricalequipment.booth_no')" :required="true"
                        :placeholder="__('Booth No')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Contact Fullname'):</label>
                    <x-core-input name="electricalequipment[contact_fullname]" :value="old('electricalequipment.contact_fullname')" :required="true"
                        :placeholder="__('Contact Fullname')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Contact Phone'):</label>
                    <x-core-input name="electricalequipment[contact_phone]" :value="old('electricalequipment.contact_phone')" :required="true"
                        :placeholder="__('Contact Phone')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Payment method'):</label>
                    <x-core-select name="electricalequipment[payment_method]" :required="true">
                        @foreach ($payment_methods as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="mb-3">
                    <label class="form-label">@lang('VAT'):</label>
                    <x-core-input name="electricalequipment[taxrate]" :value="old('electricalequipment.taxrate')" :required="true"
                        :placeholder="__('VAT')" />
                </div>
            </div>
             <div class="col-12 col-md-1">
                <div class="mb-3">
                    <label class="form-label">@lang('Surcharge'):</label>
                    <x-core-select name="electricalequipment[surcharge]" :required="true">
                        @foreach ($surcharge as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Status'):</label>
                    <x-core-select name="electricalequipment[status]" :required="true">
                        @foreach ($status as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div><div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Approved_by'):</label>
                    <x-core-input name="electricalequipment[approved_by]" :value="old('electricalequipment.approved_by')" :required="true"
                    :placeholder="__('Approved_by')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Amount'):</label>
                    <x-core-input name="electricalequipment[amount]" :value="old('electricalequipment.amount')" :required="true"
                        :placeholder="__('Amount')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label class="form-label">@lang('Total Amount'):</label>
                    <x-core-input class="input-format-number" name="electricalequipment[total_amount]" :value="old('electricalequipment.total_amount')" :required="true"
                        :placeholder="__('Total Amount')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Desc'):</label>
                    <x-core-input name="electricalequipment[desc]" :value="old('electricalequipment.desc')" :required="true"
                        :placeholder="__('Desc')" />
                </div>
            </div>
        </div>
    </div>
</div>
