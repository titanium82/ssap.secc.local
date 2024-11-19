<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="exhibition_event[name]" :value="old('exhibition_event.name')" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="exhibition_event[short_name]" :value="old('exhibition_event.short_name')" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
            <div class="col-6 md-3">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition location'):</label>
                    <x-core-select class="select2-bs5-ajax-many" name="exhibition_location_id[]" :required="true" :multiple="true" :data-url="route('admin.exhibition_location.search_select')">
                    </x-core-select>
                </div>
            </div>
            <div class="col-6 mb-3">
                <label class="form-label">@lang('Exhibition Event Organization'):</label>
                <x-core-select name="exhibition_event[customer_id]" :required="true">
                    @foreach ($customer as $customer)
                        <x-core-select-option :value="$customer->id" :title="$customer->fullname" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Day Begin'):</label>
                    <x-core-input type="date" name="exhibition_event[day_begin]" :value="old('exhibition_event.day_begin')" :required="true"
                        :placeholder="__('Day End')" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Day End'):</label>
                    <x-core-input type="date" name="exhibition_event[day_end]" :value="old('exhibition_event.day_end')" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">@lang('Event Manager'):</label>
                    <x-core-input name="exhibition_event[event_manager]" :value="old('exhibition_event.event_manager')" :required="true"
                        :placeholder="__('Event Manager')" />
                </div>
            </div>
        </div>
    </div>
</div>
