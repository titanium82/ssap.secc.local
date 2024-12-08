<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="warehouse" action="{{ route('admin.warehouse.update') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$warehouse->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Warehouse')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Warehouse Name'):</label>
                                <x-core-input name="name" :value="$warehouse->name" :required="true"
                                    :placeholder="__('Warehouse Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Warehouse Short Name'):</label>
                                <x-core-input name="short_name" :value="$warehouse->short_name" :required="true"
                                    :placeholder="__('Warehouse Short Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Warehouse Desc'):</label>
                                <x-core-input name="desc" :value="$warehouse->desc" :required="true"
                                    :placeholder="__('Warehouse Desc')" />
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
