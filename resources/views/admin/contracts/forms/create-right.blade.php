<div class="col-12 col-md-3">
    <div id="blockSubmit" class="card">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-items-center h-100 gap-2">
                <button type="submit" class="btn btn-primary" title="@lang('save')" name="submitter" value="save">@lang('save')</button>
                <button type="submit" class="btn" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </button>
            </div>
        </div>
    </div>
    @adminaccessroutename('admin.contract_payment.create')
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <span>@lang('Contract Payment')</span>
                <button type="button" class="btn btn-primary btn-icon create-ct"><i class="ti ti-plus"></i></button>
        </div>
        <div id="cotntractPayment" class="list-group list-group-flush">
        </div>
    </div>
    <div id="total_amount" class="card">
        <div class="card-header amount">
            @lang('Amount:&nbsp;')<div class="input-format-number"></div>đ
        </div>
        <div id="error_message" style="display:none; color: red; text-align:center;"></div>
    </div>
    @endadminaccessroutename
</div>
