@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.department.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$event_service_type->id" />
                <div class="row justify-content-center">
                    @include('admin.department.forms.edit-left')
                    @include('admin.department.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
