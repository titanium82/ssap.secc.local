@adminaccessroutename('admin.customer_contact.edit')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <a href="{{ route('admin.customer_contact.edit', $id) }}" class="btn btn-icon btn-warning">
            <i class="ti ti-edit"></i>
        </a>
    @endif
@endadminaccessroutename
@adminaccessroutename('admin.customer_contact.delete')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="customer_contact" data-route="{{ route('admin.customer_contact.delete', $id) }}" data-target="#modalAjaxDelete">
            <i class="ti ti-trash"></i>
        </button>
    @endif
@endadminaccessroutename
