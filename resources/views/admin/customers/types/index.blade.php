@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('list')</h2>
                    @adminaccessroutename('admin.customer_type.create')
                        <button type="button" data-route="{{ route('admin.customer_type.create') }}" class="btn btn-primary open-modal-form">
                            <i class="ti ti-plus"></i>
                            <span>@lang('add')</span>
                        </button>
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
<!-- button in datatable -->
<script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('js')

{{ $dataTable->scripts() }}

@include('admin.scripts.datatable-toggle-columns', [
    'id_table' => $dataTable->getTableAttribute('id')
])
@endpush
