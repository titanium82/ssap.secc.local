<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Exhibition Event'):</label>
                    <x-core-select name="electricalequipment[exhibition_event_id]" :required="true">
                        @foreach ($exhibitionevents as $exhibitionevent)
                            <x-core-select-option :data-short-name="$exhibitionevent->short_name" :value="$exhibitionevent->id" :title="$exhibitionevent->name" />
                        @endforeach
                    </x-core-select>
                </div>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="name" :value="old('name')" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
        </div>
    </div>
</div>