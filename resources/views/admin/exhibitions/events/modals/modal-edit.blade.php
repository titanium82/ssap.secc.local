<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="exhibition_location" action="{{ route('admin.exhibition_location.update') }}" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$exhibition_location->id" />
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Exhibition Location')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Exhibition Location Name'):</label>
                                <x-core-input name="name" :value="$exhibition_location->name" :required="true"
                                    :placeholder="__('Exhibition Location Name')" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Location'):</label>
                                <x-core-input name="location" :value="$exhibition_location->location"
                                    :placeholder="__('Location')" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Exhibition Location Stretch'):</label>
                                <x-core-input name="stretch" :value="$exhibition_location->stretch"
                                    :placeholder="__('Exhibition Location Stretch')" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Classroom'):</label>
                                <x-core-input name="classroom" :value="$exhibition_location->classroom"
                                    :placeholder="__('Classroom')" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Theater'):</label>
                                <x-core-input name="theater" :value="$exhibition_location->theater"
                                    :placeholder="__('Theater')" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">@lang('Screen Projector'):</label>
                                <x-core-input name="screen_projector" :value="$exhibition_location->screen_projector"
                                    :placeholder="__('Screen Projector')" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('Sound'):</label>
                                <x-core-select name="sound" :value="$exhibition_location->sound"
                                    :placeholder="__('sound')">
                                    <option value="Có">Có</option>
                                    <option value="Không">Không</option>
                                </x-core-select>
                                {{-- <x-core-input name="sound" :value="$exhibition_location->sound"
                                    :placeholder="__('Sound')" /> --}}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('Light'):</label>
                                <x-core-select name="light" :value="$exhibition_location->light"
                                    :placeholder="__('light')">
                                    <option value="Có">Có</option>
                                    <option value="Không">Không</option>
                                </x-core-select>
                                {{-- <x-core-input name="light" :value="$exhibition_location->light"
                                    :placeholder="__('Light')" /> --}}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('Wifi'):</label>
                                <x-core-select name="wifi" :value="$exhibition_location->wifi"
                                    :placeholder="__('Wifi')">
                                    <option value="Có">Có</option>
                                    <option value="Không">Không</option>
                                </x-core-select>
                                {{-- <x-core-input name="wifi" :value="$exhibition_location->wifi"
                                    :placeholder="__('Wifi')" /> --}}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('Air Conditioner'):</label>
                                <x-core-select name="air_conditioner" :value="$exhibition_location->air_conditioner"
                                    :placeholder="__('Air Conditioner')">
                                    <option value="Có">Có</option>
                                    <option value="Không">Không</option>
                                </x-core-select>
                                {{-- <x-core-input name="air_conditioner" :value="$exhibition_location->air_conditioner"
                                    :placeholder="__('Air Conditioner')" /> --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Screen Backdrop'):</label>
                                <x-core-input name="screen_backdrop" :value="$exhibition_location->screen_backdrop"
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
