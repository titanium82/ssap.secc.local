<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="electrical_equipment_type" action="{{ route('admin.electrical_equipment_type.store') }}" type="post" :validate="true">
                <div class="modal-header">
                    <div class="col-12 mb-3">
                        <label class="form-label">@lang('Electrical Equipment Type'):</label>
                        <x-core-select name="electrical_equipment_type_id" :required="true">
                            @foreach ($types as $type)
                                <x-core-select-option :value="$types->id" :title="$types->name" />
                            @endforeach
                        </x-core-select>
                    </div>
                    <h5 class="modal-title">@lang('Create Electrical Equipment Type')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Electrical Equipment Type Name'):</label>
                                <x-core-input name="name" :value="old('name')" :required="true"
                                    :placeholder="__('Electrical Equipment Type Name')" />
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
