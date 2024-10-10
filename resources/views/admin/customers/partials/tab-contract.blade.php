<div class="mt-3 table-responsive position-relative">
    <div class="text-end">
        @adminaccessroutename('admin.contract.create')
            <a href="{{ route('admin.contract.create', $customer->id) }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                <span>@lang('Add contract')</span>
            </a>
        @endadminaccessroutename
    </div>
    {{ $customer_contract_datatable->table(['class' => 'table table-bordered'], true) }}
</div>