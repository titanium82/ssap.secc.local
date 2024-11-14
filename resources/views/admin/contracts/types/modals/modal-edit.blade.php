<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="contract_type" action="{{ route('admin.contract_type.update') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$contract_type->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Contract Type')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Contract Type Name'):</label>
                                <x-core-input name="name" :value="$contract_type->name" :required="true"
                                    :placeholder="__('Contract Type Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Short name'):</label>
                                <x-core-input name="short_name" :value="$contract_type->short_name" :required="true"
                                    :placeholder="__('Short name')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </x-core-form>
        </div>
    </div>
</div>