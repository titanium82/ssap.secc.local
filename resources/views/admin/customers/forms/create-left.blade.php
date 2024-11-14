<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-9">
                <div class="mb-3">
                    <label class="form-label">@lang('Fullname'):</label>
                    <x-core-input name="fullname" :value="old('fullname')" :required="true"
                        :placeholder="__('Fullname')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Shortname'):</label>
                    <x-core-input name="shortname" :value="old('shortname')" :required="true"
                        :placeholder="__('Shortname')" />
                </div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">@lang('Customer Type'):</label>
                <x-core-select name="customer_type_id" :required="true">
                    @foreach ($types as $type)
                        <x-core-select-option :value="$type->id" :title="$type->name" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Tel'):</label>
                    <x-core-input-phone name="phone" :value="old('phone')" :required="true"
                        :placeholder="__('Phone')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Fax'):</label>
                    <x-core-input name="fax" :value="old('fax')" :placeholder="__('Fax')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Email'):</label>
                    <x-core-input-email name="email" :value="old('email')" :required="true"
                        :placeholder="__('Email')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Address'):</label>
                    <x-core-input name="address" :value="old('address')" :placeholder="__('Address')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Taxcode'):</label>
                    <x-core-input name="taxcode" :value="old('taxcode')" :placeholder="__('Taxcode')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Address vat'):</label>
                    <x-core-input name="address_vat" :value="old('address_vat')" :placeholder="__('Address vat')" />
                </div>
            </div>
            <div class="col-12 col-md-2">
                <label class="form-label">@lang('Gender'):</label>
                <x-core-select name="gender" :required="true">
                    @foreach ($gender as $key => $value)
                        <x-core-select-option :value="$key" :title="$value" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Delegate'):</label>
                    <x-core-input name="delegate" :value="old('delegate')" :placeholder="__('Delegate')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Website'):</label>
                    <x-core-input name="website" :value="old('website')" :placeholder="__('Website')" />
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">@lang('Note'):</label>
                <textarea name="note" class="form-control">{{ old('note') }}</textarea>
            </div>
        </div>
    </div>
</div>
