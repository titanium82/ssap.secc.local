@adminaccessroutename('admin.customer.show')
    <a href="{{ route('admin.customer.show', $id) }}" class="btn btn-icon btn-info">
        <i class="ti ti-eye"></i>
    </a>
@endadminaccessroutename
@adminaccessroutename('admin.customer.edit')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <a href="{{ route('admin.customer.edit', $id) }}" class="btn btn-icon btn-warning">
            <i class="ti ti-edit"></i>
        </a>
    @endif
@endadminaccessroutename
@adminaccessroutename('admin.customer.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="customer" data-route="{{ route('admin.customer.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
