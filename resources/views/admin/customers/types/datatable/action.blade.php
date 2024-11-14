@adminaccessroutename('admin.customer_type.edit')
<button type="button" data-route="{{ route('admin.customer_type.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
    <i class="ti ti-edit"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.customer_type.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="customer_type" data-route="{{ route('admin.customer_type.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
