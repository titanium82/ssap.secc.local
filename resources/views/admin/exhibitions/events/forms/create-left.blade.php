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
                    <x-core-input name="exhibitionevent[shortname]" :value="old('exhibitionevent.shortname')" :required="true"
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
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_begin]" :value="old('exhibitionevent.day_begin')" :required="true"
                        :placeholder="__('Day Begin')" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Day End'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_end]" :value="old('exhibitionevent.day_end')" :required="true"
                        :placeholder="__('Day End')" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Manager'):</label>
                    <x-core-select name="exhibitionevent[event_manager]" :required="true">
                        @foreach ($eventmanager as $key => $value)
                            <x-core-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
        </div>
    </div>
</div>
