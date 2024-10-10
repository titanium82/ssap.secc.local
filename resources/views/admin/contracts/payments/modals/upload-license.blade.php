<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" action="{{ route('admin.contract_payment.handle_upload_license') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$contract_payment->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Upload license')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <x-core-input-gallery-ckfinder name="license" :value="$contract_payment->license" :label="trans('Licenser')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Upload')</button>
                </div>
            </x-core-form>
        </div>
    </div>
</div>