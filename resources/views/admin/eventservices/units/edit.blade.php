@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.event_service_unit.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$event_service_unit->id" />
                <div class="row justify-content-center">
                    @include('admin.eventservices.units.forms.edit-left')
                    @include('admin.eventservices.units.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
