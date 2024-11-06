<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="event_service_unit" action="{{ route('admin.event_service_unit.store') }}" type="post" :validate="true">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Create Event Service Unit')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 mb-3">
                                <label class="form-label">@lang('Event Service Type'):</label>
                                <x-core-select name="event_service_type_id" :required="true">
                                    @foreach ($types as $type)
                                        <x-core-select-option :value="$type->id" :title="$type->name" />
                                    @endforeach
                                </x-core-select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('Unit'):</label>
                                    <x-core-select name="unit" :required="true">
                                        @foreach ($unit as $key => $value)
                                            <x-core-select-option :value="$key" :title="$value" />
                                        @endforeach
                                    </x-core-select>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                     <label class="form-label">@lang('Desc'):</label>
                                     <x-core-input name="desc" :value="old('desc')"
                                        :placeholder="__('Desc')" />
                                </div>
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
