@adminaccessroutename('admin.customer_sector.edit')
    <button type="button" data-route="{{ route('admin.customer_sector.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
        <i class="ti ti-edit"></i>
    </button>
@endadminaccessroutename
@adminaccessroutename('admin.customer_sector.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="customer_sector" data-route="{{ route('admin.customer_sector.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
