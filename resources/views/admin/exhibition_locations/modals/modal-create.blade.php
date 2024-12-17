<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="exhibition_location" action="{{ route('admin.exhibition_location.store') }}" type="post" :validate="true">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Create Exhibition Location')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Exhibition Location Name'):</label>
                                <x-core-input name="name" :value="old('name')" :required="true"
                                    :placeholder="__('Exhibition Location Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Exhibition Location Stretch'):</label>
                                <x-core-input name="stretch" :value="old('stretch')" :required="true"
                                    :placeholder="__('Exhibition Location Stretch')" />
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