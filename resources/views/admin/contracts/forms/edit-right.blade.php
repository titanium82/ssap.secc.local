<div class="col-12 col-md-3">
    <div id="blockSubmit" class="card">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <div class="d-flex align-items-center h-100 gap-2">
                <button type="submit" class="btn btn-primary" title="@lang('save')" name="submitter" value="save">@lang('save')</button>
                <button type="submit" class="btn" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </button>
            </div>
            <button type="button" class="btn btn-danger open-modal-delete" data-route="{{ route('admin.contract.delete', $contract->id) }}" data-target="#modalDelete">
                @lang('Delete')
            </button>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            @lang('Status')
        </div>
        <div class="card-body p-2">
            <span @class([
                'badge', 'bg-green' => $contract->statusValid(), 'bg-red' => !$contract->statusValid()
            ])>
                @lang('Valid') 
            </span>
            <span @class([
                'ms-1 badge', $contract->status->badge()
            ])>
                {{ $contract->status->description() }} 
            </span>
        </div>
    </div>
    @adminaccessroutename('admin.contract_payment.index')
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <span>@lang('Contract Payment')</span>
        </div>
        <div id="cotntractPayment" class="list-group list-group-flush">
            @foreach ($contract->payments as $contract_payment)
                @include('admin.contracts.payments.quick', [
                    'contract_payment' => $contract_payment,
                    'ct_key' => $contract_payment->id
                ])
            @endforeach
        </div>
    </div>
    @endadminaccessroutename
</div>