<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Contract'):</label>
                    <x-core-input name="contract_id" :value="$contract_payment->contract?->code" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Period'):</label>
                    <x-core-input name="period" :value="$contract_payment->period" readonly />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Expired'):</label>
                    <x-core-input type="date" name="expired_at" :value="$contract_payment->expired_at->format('Y-m-d')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Amount'):</label>
                    <x-core-input class="input-format-number" name="amount" :value="number_format($contract_payment->amount)" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <x-core-input-gallery-ckfinder name="license" :value="$contract_payment->license" :label="trans('Licenser')" />
                </div>
            </div>
        </div>
    </div>
</div>
