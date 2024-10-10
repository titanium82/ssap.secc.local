@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.role.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.roles.forms.create-left')
                    @include('admin.roles.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')

@endpush
