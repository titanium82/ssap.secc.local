@adminaccessroutename('admin.contract_type.edit')
<button type="button" data-route="{{ route('admin.contract_type.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
    <i class="ti ti-edit"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.contract_type.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="contract_type" data-route="{{ route('admin.contract_type.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename

