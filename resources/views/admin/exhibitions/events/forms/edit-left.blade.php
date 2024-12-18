<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="exhibitionevent[name]" :value="$exhibition_events->name" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="exhibitionevent[short_name]" :value="$exhibition_events->short_name" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition location'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="exhibition_location_id[]" :required="true" :multiple="true" :data-url="route('admin.exhibition_location.search_select')">
                        @foreach ($exhibition_events->exhibitionLocations as $exhibition_location)
                            <x-core-select-option :option="$exhibition_location->id" :value="$exhibition_location->id" :title="$exhibition_location->fullname" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Customer'):</label>
                    <x-core-select name="exhibitionevent[customer_id]" :required="true">
                    @foreach($customer as $customer)
                        <x-core-select-option :option="$exhibition_events->customer_id" :value="$customer->id" :title="$customer->short_name"/>
                    @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_begin]" :value="$exhibition_events->day_begin" readonly :required="true"
                        :placeholder="__('Day Begin')" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Day End'):</label>
                    <x-core-input type="date" name="exhibitionevent[day_end]" :value="$exhibition_events->day_end" readonly :required="true"
                        :placeholder="__('Day End')" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Status'):</label>
                    <x-core-select name="exhibitionevent[status]" :required="true">
                        @foreach ($eventstatus as $key => $value)
                            <x-core-select-option :option="$exhibition_events->eventstatus?->value" :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Manager'):</label>
                    <x-core-select name="exhibitionevent[event_manager]" :required="true">
                        @foreach ($eventmanager as $key => $value)
                            <x-core-select-option :option="$exhibition_events->eventmanager?->value" :value="$key" :title="$value" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">@lang('Layouts'):</label>
                <x-core-input-file-pond name="exhibitionevent[layouts][]" :value="$exhibition_events->layouts?->toArray()" style="opacity: 0" />
            </div>
        </div>
    </div>
</div>
