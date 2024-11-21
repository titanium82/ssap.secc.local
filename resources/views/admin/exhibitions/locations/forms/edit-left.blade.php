<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="fullname" :value="$exhibition_location->fullname" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="stretch" :value="$exhibition_location->stretch" :required="true"
                        :placeholder="__('Stretch')" />
                </div>
            </div>
        </div>
    </div>
</div>
