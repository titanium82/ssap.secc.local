<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Info')</h5>
                @if ($contract_payment->paid())
                    <span>@lang('Approved by'): <span class="badge bg-green">{{ $contract_payment->approvedBy?->fullname }}</span></span>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Code contract'):</label>
                            <x-core-input name="contract_id" :value="$contract_payment->contract?->code" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Period'):</label>
                            <x-core-input name="period" :value="$contract_payment->period" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Status'):</label>
                            <x-core-input name="status" :value="$contract_payment->status->description()" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Expired'):</label>
                            <x-core-input type="date" name="expired_at" :value="$contract_payment->expired_at->format('Y-m-d')" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Amount'):</label>
                            <x-core-input-number name="amount" :value="format_price($contract_payment->amount)" readonly/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <x-core-input-gallery-ckfinder name="license" :value="$contract_payment->license" readonly :label="trans('Licenser')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>