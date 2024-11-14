@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row card-body">
                    <div class="col-12 col-md-4">
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
        </div>
    </div>
@endsection

