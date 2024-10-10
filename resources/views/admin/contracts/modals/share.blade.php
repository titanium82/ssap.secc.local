<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" action="{{ route('admin.contract.handle_share') }}" type="post" :validate="true">
                <x-core-input type="hidden" name="contract_id" :value="$contract->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Share contract')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Admin'):</label>
                                <x-core-select class="select2-bs5-ajax-many" name="admin_id[]" :multiple="true" :required="true" data-url="{{ route('admin.admin.search_select') }}">
                                    @foreach ($contract->sharers as $sharer)
                                        <x-core-select-option :option="$sharer->id" :value="$sharer->id" :title="$sharer->fullname" />
                                    @endforeach
                                </x-core-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Send')</button>
                </div>
            </x-core-form>
        </div>
    </div>
</div>