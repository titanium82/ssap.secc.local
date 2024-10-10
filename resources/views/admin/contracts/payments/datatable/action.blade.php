@adminaccessroutename('admin.contract_payment.show')
    <button type="button" data-route="{{ route('admin.contract_payment.show', $contract_payment->id) }}" class="btn btn-icon btn-info open-modal-form">
        <i class="ti ti-eye"></i>
    </button>
@endadminaccessroutename

@adminaccessroutename('admin.contract_payment.upload_license')
@if ($contract_payment->canUploadLicense())
    <button type="button" data-route="{{ route('admin.contract_payment.upload_license', $contract_payment->id) }}" class="btn btn-icon btn-success open-modal-form">
        <i class="ti ti-upload"></i>
    </button>
@endif
@endadminaccessroutename

@adminaccessroutename('admin.contract_payment.edit')
    <a href="{{ route('admin.contract_payment.edit', $contract_payment->id) }}" class="btn btn-icon btn-warning">
        <i class="ti ti-edit"></i>
    </a>
@endadminaccessroutename

@adminaccessroutename('admin.contract_payment.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="contract_payment" data-route="{{ route('admin.contract_payment.delete', $contract_payment->id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
