<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Information Exhibition Event')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Event Name'):</label>
                            <x-core-input name="name" :value="$exhibitionevent->name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Exhibition Event Short Name'):</label>
                            <x-core-input name="short_name" :value="$exhibitionevent->short_name" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <label class="form-label">@lang('Customer'):</label>
                            <x-core-input name="stretch" :value="$exhibitionevent->customer?->fullname" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Event Manager'):</label>
                            <x-core-input name="amount" :value="$exhibitionevent->event_manager" readonly="true"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Day Begin'):</label>
                            <x-core-input type="date" name="day_begin" :value="$exhibitionevent->day_begin" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Day End'):</label>
                            <x-core-input type="date" name="day_end" :value="$exhibitionevent->day_end" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Status'):</label>
                            <span @class(['ms-2 badge', $exhibitionevent->status->badge()])>{{ $exhibitionevent->status->description() }}</span>
                            {{-- <x-core-input name="status" :value="$exhibitionevent->status->description()" readonly="true"/> --}}
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">@lang('Exhibition Location'):</label>
                            <x-core-input :value="$exhibitionevent->exhibitionlocations->pluck('fullname')->implode(', ')" :readonly="true" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">@lang('Desc'):</label>
                            <x-core-input name="desc" :value="$exhibitionevent->desc" readonly="true"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <x-core-input-file-ckfinder name="layouts" :value="$exhibitionevent->layouts" :readonly="true" :label="trans('Layouts')"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
