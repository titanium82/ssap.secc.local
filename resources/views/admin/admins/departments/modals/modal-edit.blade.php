<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="department" action="{{ route('admin.department.update') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$department->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Department')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Department Name'):</label>
                                <x-core-input name="name" :value="$department->name" :required="true"
                                    :placeholder="__('Department Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Department Short Name'):</label>
                                <x-core-input name="shortname" :value="$department->shortname" :required="true"
                                    :placeholder="__('Department Short Name')" />
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
