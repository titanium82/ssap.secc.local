@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('list')</h2>
                        <div class="d-flex gap-2">
                            @adminaccessroutename('admin.customer.import_excel')
                                <x-core-form :action="route('admin.customer.import_excel')" enctype="multipart/form-data" type="post">
                                    <input type="file" name="file" id="importExcel" class="form-control d-none" onchange="this.form.submit()" />
                                    <button type="button" class="btn btn-primary gap-1" onclick="document.getElementById('importExcel').click()">
                                        <i class="ti ti-file-upload"></i> @lang('Import Excel')
                                    </button>
                                </x-core-form>
                            @endadminaccessroutename
                            @adminaccessroutename('admin.electrical_equipment.create')
                                <a href="{{ route('admin.electrical_equipment.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    <span>@lang('add')</span>
                                </a>
                            @endadminaccessroutename
                        </div>
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
