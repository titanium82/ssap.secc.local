@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.exhibition_event.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$exhibition_events->id" />
                <div class="row justify-content-center">
                    @include('admin.exhibitions.events.forms.edit-left')
                    @include('admin.exhibitions.events.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
