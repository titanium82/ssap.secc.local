@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.permission.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$permission->id" />
                <div class="row justify-content-center">
                    @include('admin.permissions.forms.edit-left')
                    @include('admin.permissions.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
