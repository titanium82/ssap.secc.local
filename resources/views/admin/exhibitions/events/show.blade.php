@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row card-body">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Event Name'):</label>
                            <x-core-input name="contract_id" :value="$exhibitionevent->name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Event Short Name'):</label>
                            <x-core-input name="period" :value="$exhibitionevent->short_name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Customer'):</label>
                            <x-core-input name="status" :value="$exhibitionevent->customer?->fullname" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Day Begin'):</label>
                            <x-core-input type="date" name="expired_at" :value="$exhibitionevent->day_begin->format('d-m-Y')" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Day End'):</label>
                            <x-core-input type="date" name="expired_at" :value="$exhibitionevent->day_end" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Status'):</label>
                            <x-core-input name="amount" :value="$exhibitionevent->event_manager" readonly="true"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Status'):</label>
                            <x-core-input name="amount" :value="$exhibitionevent->status->description()" readonly="true"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Status'):</label>
                            <x-core-input name="amount" :value="$exhibitionevent->desc" readonly="true"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <x-core-input-file-ckfinder name="layouts" :value="$exhibitionevent->layouts" :readonly="true" :label="trans('Layouts')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

