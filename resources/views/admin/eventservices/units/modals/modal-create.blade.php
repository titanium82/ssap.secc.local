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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">@lang('Name'):</label>
                                <x-core-input name="name" :value="old('name')" :placeholder="__('Name')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">@lang('Unit'):</label>
                                    <x-core-select name="unit" :required="true">
                                        @foreach ($unit as $key => $value)
                                            <x-core-select-option :value="$key" :title="$value" />
                                        @endforeach
                                    </x-core-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                     <label class="form-label">@lang('Width'):</label>
                                     <x-core-input name="width" :value="old('width')"
                                        :placeholder="__('Width')" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Height'):</label>
                                    <x-core-input name="height" :value="old('height')"
                                       :placeholder="__('Height')" />
                               </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Sound'):</label>
                                    <x-core-input name="sound_system" :value="old('sound_system')"
                                       :placeholder="__('Sound System')" />
                               </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Micro'):</label>
                                    <x-core-input name="wireless_micro" :value="old('wireless_micro')"
                                       :placeholder="__('Wireless Micro')" />
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Backdrop'):</label>
                                    <x-core-input name="backdrop" :value="old('backdrop')"
                                       :placeholder="__('Backdrop')" />
                               </div>
                            </div>
                        </div>
                        <div class="row">
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
