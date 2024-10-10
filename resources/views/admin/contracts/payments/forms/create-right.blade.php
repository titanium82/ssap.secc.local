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
    <div class="card mt-3">
        <div class="card-header">@lang('File send mail')</div>
        <div class="card-body p-2">
            <x-core-input-file-pond name="file_send_mail"  style="opacity: 0" />
        </div>
    </div>
</div>
