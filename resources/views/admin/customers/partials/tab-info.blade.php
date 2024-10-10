<div class="row">
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Address'):</label>
            <x-core-input :value="$customer->address" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Email'):</label>
            <x-core-input :value="$customer->email" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Address VAT'):</label>
            <x-core-input :value="$customer->address_vat" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Taxcode'):</label>
            <x-core-input :value="$customer->taxcode" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Phone'):</label>
            <x-core-input :value="$customer->phone" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Website'):</label>
            <x-core-input :value="$customer->website" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Delegate'):</label>
            <x-core-input :value="$customer->delegate" :readonly="true" />
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-3">
            <label for="" class="form-label">@lang('Customer Sector'):</label>
            <x-core-input :value="$customer->sector?->name" :readonly="true" />
        </div>
    </div>
</div>