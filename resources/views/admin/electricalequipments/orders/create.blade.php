@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.electrical_equipment_order.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.electricalequipments.orders.forms.create-left')
                    @include('admin.electricalequipments.orders.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')
@include('admin.electricalequipments.orders.scripts.js')

@endpush
