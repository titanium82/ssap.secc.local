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
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Exhibition Location Name'):</label>
                                    <x-core-input name="fullname" :value="old('fullname')" :required="true"
                                        :placeholder="__('Exhibition Location Name')" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Location'):</label>
                                    <x-core-input name="location" :value="old('location')" :required="true"
                                        :placeholder="__('Location')" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Exhibition Location Stretch'):</label>
                                    <x-core-input name="stretch" :value="old('stretch')" :required="true"
                                        :placeholder="__('Exhibition Location Stretch')" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-4">
                                    <label class="form-label">@lang('Classroom'):</label>
                                    <x-core-input name="classroom" :value="old('classroom')" :required="true"
                                        :placeholder="__('Classroom')" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Theater'):</label>
                                    <x-core-input name="theater" :value="old('theater')" :required="true"
                                        :placeholder="__('Theater')" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Screen Projector'):</label>
                                    <x-core-input name="screen_projector" :value="old('screen_projector')" :required="true"
                                        :placeholder="__('Screen Projector')" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Sound'):</label>
                                    <x-core-select name="sound" :value="old('sound')"
                                        :placeholder="__('sound')">
                                        <option value="Có">Có</option>
                                        <option value="Không">Không</option>
                                    </x-core-select>
                                    {{-- <x-core-input name="sound" :value="old('sound')" :required="true"
                                        :placeholder="__('Sound')" /> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Light'):</label>
                                    <x-core-select name="light" :value="old('light')"
                                        :placeholder="__('light')">
                                        <option value="Có">Có</option>
                                        <option value="Không">Không</option>
                                    </x-core-select>
                                    {{-- <x-core-input name="light" :value="old('light')" :required="true"
                                        :placeholder="__('Light')" /> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('Wifi'):</label>
                                    <x-core-select name="wifi" :value="old('wifi')"
                                        :placeholder="__('Wifi')">
                                        <option value="Có">Có</option>
                                        <option value="Không">Không</option>
                                    </x-core-select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('air_conditioner'):</label>
                                    <x-core-select name="air_conditioner" :value="old('air_conditioner')"
                                        :placeholder="__('air_conditioner')">
                                        <option value="Có">Có</option>
                                        <option value="Không">Không</option>
                                    </x-core-select>
                                    {{-- <x-core-input name="air_conditioner" :value="old('air_conditioner')" :required="true"
                                        :placeholder="__('air_conditioner')" /> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Screen Backdrop'):</label>
                                <x-core-input name="screen_backdrop" :value="old('screen_backdrop')" :required="true"
                                    :placeholder="__('Screen Backdrop')" />
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
