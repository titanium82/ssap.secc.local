<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="exhibitionevent[name]" :value="old('exhibitionevent.name')" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="exhibitionevent[short_name]" :value="old('exhibitionevent.short_name')" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition Location'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="exhibition_location_id[]" :required="true" :multiple="true" :data-url="route('admin.exhibition_location.search_select')">
                    </x-core-select>
                </div>
            </div>
            <div class="col-6 mb-3">
                <label class="form-label">@lang('Exhibition Event Organization'):</label>
                <x-core-select name="exhibitionevent[customer_id]" :required="true">
                    @foreach ($customer as $customer)
                        <x-core-select-option :value="$customer->id" :title="$customer->fullname" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_begin]" :value="old('exhibitionevent.day_begin')" :required="true"
                        :placeholder="__('Day Begin')" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day End'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_end]" :value="old('exhibitionevent.day_end')" :required="true"
                        :placeholder="__('Day End')" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Status'):</label>
                    <x-core-select name="exhibitionevent[status]" :required="true">
                        @foreach ($eventstatus as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Manager'):</label>
                    <x-core-select name="exhibitionevent[event_manager]" :required="true">
                        @foreach ($eventmanager as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-12 mb-3">
                <label class="form-label">@lang('Layouts'):</label>
                <x-core-input-file-pond class="filepond-inline-2" name="exhibitionevent[layouts][]" :multiple="true" :maxFiles="6" style="opacity: 0" />
            </div>
        </div>
    </div>
</div>
