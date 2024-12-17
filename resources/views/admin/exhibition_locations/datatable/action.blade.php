@adminaccessroutename('admin.exhibition_location.edit')
<button type="button" data-route="{{ route('admin.exhibition_location.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
    <i class="ti ti-edit"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.exhibition_location.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="exhibition_location" data-route="{{ route('admin.exhibition_location.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename

