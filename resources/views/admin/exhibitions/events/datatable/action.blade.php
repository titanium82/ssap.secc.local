@adminaccessroutename('admin.exhibition_event.show')
<button type="button" data-route="{{ route('admin.exhibition_event.show', $id) }}" class="btn btn-icon btn-info open-modal-form">
    <i class="ti ti-eye"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.exhibition_event.edit')
<a href="{{ route('admin.exhibition_event.edit', $id) }}" class="btn btn-icon btn-warning">
    <i class="ti ti-edit"></i>
</a>
@endadminaccessroutename
@adminaccessroutename('admin.exhibition_event.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="exhibition_event" data-route="{{ route('admin.exhibition_event.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename

