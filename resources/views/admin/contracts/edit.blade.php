@extends('admin.layouts.master')

@push('libs-css')
<!-- Filepond stylesheet -->
<link href="{{ asset('public/core/libs/filepond/dist/filepond.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/core/libs/filepond/plugins/image-preview/dist/filepond-plugin-image-preview.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/core/libs/filepond/plugins/file-poster/filepond-plugin-file-poster.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.contract.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$contract->id" />
                <div class="row justify-content-center">
                    @include('admin.contracts.forms.edit-left')
                    @include('admin.contracts.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection
@push('libs-js')
@include('ckfinder::setup')

<!-- include FilePond library -->
<script src="{{ asset('public/core/libs/filepond/dist/filepond.min.js') }}"></script>

<!-- include FilePond plugins -->
<script src="{{ asset('public/core/libs/filepond/plugins/image-preview/dist/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-validate-size/dist/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-validate-type/dist/filepond-plugin-file-validate-type.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/image-resize/dist/filepond-plugin-image-resize.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-encode/dist/filepond-plugin-file-encode.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-poster/filepond-plugin-file-poster.min.js') }}"></script>

<!-- include FilePond jQuery adapter -->
<script src="{{ asset('public/core/libs/jquery-filepond/filepond.jquery.js') }}"></script>

@endpush

@push('js')

<script type="module" src="{{ asset('public/core/assets/js/filepond.js') }}"></script>

@endpush