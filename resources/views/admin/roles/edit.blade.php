@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.role.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$role->id" />
                <div class="row justify-content-center">
                    @include('admin.roles.forms.edit-left')
                    @include('admin.roles.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
