@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form id="formExhibitionEventStore" :action="route('admin.exhibition_event.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.exhibitions.events.forms.create-left')
                    @include('admin.exhibitions.events.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')

@endpush
