@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.customer_contact.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$customer_contact->id" />
                <div class="row justify-content-center">
                    @include('admin.customers.contacts.forms.edit-left')
                    @include('admin.customers.contacts.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')
@include('ckfinder::setup')
@endpush