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
            <x-core-form :action="route('admin.contract_payment.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$contract_payment->id" />
                <div class="row justify-content-center">
                    @include('admin.contracts.payments.forms.edit-left')
                    @include('admin.contracts.payments.forms.edit-right')
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
<script src="{{ asset('public/core/assets/js/filepond.js') }}"></script>

    @if ($contract_payment->canAccept())
        <div class="modal modal-blur fade" id="modalAccept" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-title">@lang('Are you sure?')</div>
                        <div>@lang('If you continue, the data will be Accept from the system.')</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary me-auto"
                            data-bs-dismiss="modal">@lang('cancel')</button>
                        <x-core-form action="#" type="put">
                            <button type="submit" class="btn btn-success">@lang('Accept')</button>
                        </x-core-form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(e) {
                $("#accept").click(function(e) {
                    $($(this).data('bs-target')).find('form').attr('action', $(this).data('route'));
                })
            });
        </script>
    @endif
@endpush
