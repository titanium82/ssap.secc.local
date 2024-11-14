@adminaccessroutename('admin.admin.edit')
    <a href="{{ route('admin.admin.edit', $id) }}" class="btn btn-icon btn-warning">
        <i class="ti ti-edit"></i>
    </a>
@endadminaccessroutename
@adminaccessroutename('admin.admin.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="admin" data-route="{{ route('admin.admin.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
