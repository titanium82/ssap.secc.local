@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.event_service_type.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.eventservices.types.forms.create-left')
                    @include('admin.eventservices.types.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')

@endpush
