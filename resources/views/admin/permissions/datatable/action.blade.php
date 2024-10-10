@adminaccessroutename('admin.permission.edit')
    <a href="{{ route('admin.permission.edit', $id) }}" class="btn btn-icon btn-warning">
        <i class="ti ti-edit"></i>
    </a>
@endadminaccessroutename
@adminaccessroutename('admin.permission.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="permission" data-route="{{ route('admin.permission.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
