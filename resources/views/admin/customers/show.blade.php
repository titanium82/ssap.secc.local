@extends('admin.layouts.master')
@push('css')
    <style>
        .dataTables_filter{
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img class="avatar" src="{{ asset($customer->logo) }}"></img>
                        </div>
                        <div class="col">
                            <div class="fw-bold fs-2">
                                {{ $customer->fullname }} - {{$customer->short_name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tabsInfo" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                role="tab">@lang('Info')</a>
                        </li>
                        @if($customer->isCreator() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer())
                            <li class="nav-item" role="presentation">
                                <a href="#tabscontract" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                                    tabindex="-1">@lang('Contract')</a>
                            </li>
                        @endif
                        @if($customer->isCreator() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer())
                            <li class="nav-item" role="presentation">
                                <a href="#tabsexhibitionevent" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                                    tabindex="-1">@lang('Exhibition Event')</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabsInfo" role="tabpanel">
                            @include('admin.customers.partials.tab-info')
                            @include('admin.customers.partials.tab-contact')
                        </div>
                        @if($customer->isCreator() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer())
                            <div class="tab-pane" id="tabscontract" role="tabpanel">
                                @include('admin.customers.partials.tab-contract')
                            </div>
                        @endif
                        @if($customer->isCreator() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer())
                            <div class="tab-pane" id="tabsexhibitionevent" role="tabpanel">
                                @include('admin.customers.partials.tab-exhibitionevent')
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

{{ $customer_contact_datatable->scripts() }}
{{ $customer_contract_datatable->scripts() }}
{{ $customer_exhibitionevent_datatable->scripts() }}


@endpush
