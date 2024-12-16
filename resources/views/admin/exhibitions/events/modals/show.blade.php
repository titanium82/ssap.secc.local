<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Exhibition Location')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Location Name'):</label>
                            <x-core-input name="name" :value="$exhibitionevent->name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">@lang('Location'):</label>
                            <x-core-input name="location" :value="$exhibitionevent->short_name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Location Stretch'):</label>
                            <x-core-input name="stretch" :value="$$exhibitionevent->customer->short_name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Classroom'):</label>
                            <x-core-input name="classroom" :value="$exhibition_location->classroom" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Theater'):</label>
                            <x-core-input-number name="theater" :value="$exhibition_location->theater" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
