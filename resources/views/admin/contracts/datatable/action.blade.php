@adminaccessroutename('admin.contract.show')
    <a href="{{ route('admin.contract.show', $id) }}" class="btn btn-icon btn-info">
        <i class="ti ti-eye"></i>
    </a>
@endadminaccessroutename
@adminaccessroutename('admin.contract.share')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer())
        <button type="button" data-route="{{ route('admin.contract.share', $id) }}" class="btn btn-icon btn-cyan open-modal-form">
            <i class="ti ti-share"></i>
        </button>
    @endif
@endadminaccessroutename
@adminaccessroutename('admin.contract.payment_send_email')
    <button type="button" data-route="{{ route('admin.contract.payment_send_email', $id) }}" class="btn btn-icon btn-success open-modal-form">
        <i class="ti ti-mail"></i>
    </button>
@endadminaccessroutename
@adminaccessroutename('admin.contract.edit')
    <a href="{{ route('admin.contract.edit', $id) }}" class="btn btn-icon btn-warning">
        <i class="ti ti-edit"></i>
    </a>
@endadminaccessroutename
@adminaccessroutename('admin.contract.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="contract" data-route="{{ route('admin.contract.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
