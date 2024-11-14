@adminaccessroutename('admin.event_service.edit')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <a href="{{ route('admin.event_service.edit', $id) }}" class="btn btn-icon btn-warning">
            <i class="ti ti-edit"></i>
        </a>
    @endif
@endadminaccessroutename
@adminaccessroutename('admin.event_service.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="event_service" data-route="{{ route('admin.event_service.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
