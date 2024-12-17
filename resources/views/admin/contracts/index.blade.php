@extends('admin.layouts.master')
@push('libs-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/core/libs/tagify/tagify.css') }}" />
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('list')</h2>
                    @adminaccessroutename('admin.contract.create')
                        <a href="{{ route('admin.contract.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i>
                            <span>@lang('add')</span>
                        </a>
                    @endadminaccessroutename
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        @include('admin.datatables.toggle-column-datatable')
                        {{ $dataTable->table(['class' => 'table table-bordered'], true) }}
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('libs-js')

<script src="{{ asset('public/core/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/core/libs/ckeditor/adapters/jquery.js') }}"></script>
<!-- button in datatable -->
<script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('/public/core/libs/tagify/tagify.js') }}"></script>
@endpush

@push('js')

{{ $dataTable->scripts() }}

@include('admin.scripts.datatable-toggle-columns', [
    'id_table' => $dataTable->getTableAttribute('id')
])
@endpush
