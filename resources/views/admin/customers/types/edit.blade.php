@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.customer_type.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$customer_type->id" />
                <div class="row justify-content-center">
                    @include('admin.customers.types.forms.edit-left')
                    @include('admin.customers.types.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
