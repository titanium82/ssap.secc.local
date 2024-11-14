@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.contract_type.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$contract_type->id" />
                <div class="row justify-content-center">
                    @include('admin.contracts.types.forms.edit-left')
                    @include('admin.contracts.types.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
