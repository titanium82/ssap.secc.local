@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img class="avatar" src="{{ asset($contract->customer->logo) }}"></img>
                        </div>
                        <div class="col">
                            <div class="fw-bold fs-2">
                                {{ $contract->customer->fullname }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-7 col-12">
                    <div class="card">
                        <div class="card-header">
                            @lang('Info')
                        </div>
                        <div class="card-body row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Contract Type'):</label>
                                    <x-core-input :value="$contract->type?->name" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Contract Code'):</label>
                                    <x-core-input :value="$contract->code" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Day Begin'):</label>
                                    <x-core-input :value="$contract->day_begin->format(config('core.format.date'))" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Day End'):</label>
                                    <x-core-input :value="$contract->day_end->format(config('core.format.date'))" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Deposit'):</label>
                                    <x-core-input :value="format_price($contract->deposit, '', $contract->currency->name)" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Total'):</label>
                                    <x-core-input :value="format_price($contract->total_amount, '', $contract->currency->name)" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Payment method'):</label>
                                    <x-core-input :value="$contract->payment_method->description()" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Status'):</label>
                                    <x-core-input :value="$contract->status->description()" :readonly="true" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">@lang('Note'):</label>
                                    <textarea class="form-control" readonly="true">{{ $contract->note }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <x-core-input-file-ckfinder name="files" :value="$contract->files" :readonly="true" :label="trans('Files')"/>
                            </div>
                            <div class="col-12 col-md-6">
                                <x-core-input-file-ckfinder name="annex" :value="$contract->annex" :readonly="true" :label="trans('Annex')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">@lang('Contract Payment')</div>
                        <div class="card-body">
                            <ul class="steps steps-vertical">
                                @foreach ($contract->payments as $payment)
                                    <li class="step-item">
                                        <div class="h4 m-0">
                                            <a href="{{ route('admin.contract_payment.show', $payment->id) }}" target="_blank">@lang('Payment period :p', ['p' => $payment->period])</a>
                                            <span @class(['ms-2 badge', $payment->status->badge()])>{{ $payment->status->description() }}</span>
                                        </div>
                                        <div class="text-secondary">
                                            @lang('Amount :a with experid at :e', ['a' => format_price($payment->amount, '', $contract->currency->name), 'e' => $payment->expired_at->format(config('core.format.date'))])
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
