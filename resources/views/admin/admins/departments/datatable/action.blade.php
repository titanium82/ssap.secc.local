@adminaccessroutename('admin.department.edit')
<button type="button" data-route="{{ route('admin.department.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
    <i class="ti ti-edit"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.department.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="department" data-route="{{ route('admin.department.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename