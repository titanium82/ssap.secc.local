@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.electrical_equipment.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$electricalequipment->id" />
                <div class="row justify-content-center">
                    @include('admin.electricalequipments.forms.edit-left')
                    @include('admin.electricalequipments.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
@push('libs-js')
@include('ckfinder::setup')
@endpush
