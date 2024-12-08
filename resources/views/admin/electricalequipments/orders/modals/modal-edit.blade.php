<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="electrical_equipment_type" action="{{ route('admin.electrical_equipment_type.update') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$electrical_equipment_type->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Electrical Equipment Type')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Electrical Equipment Type Name'):</label>
                                <x-core-input name="name" :value="$electrical_equipment_type->name" :required="true"
                                    :placeholder="__('Event Electrical Equipment Type Name')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Edit Electrical Equipment Type Desc'):</label>
                                <x-core-input name="desc" :value="$electrical_equipment_type->desc" :required="true"
                                    :placeholder="__('Event Electrical Equipment Type Desc')" />
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
