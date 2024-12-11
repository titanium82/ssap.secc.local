<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Name'):</label>
                    <x-core-input name="name" :value="$electricalequipment->code" :required="true"
                        :placeholder="__('Name')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Short Name'):</label>
                    <x-core-input name="short_name" :value="$electricalequipment->short_name" :required="true"
                        :placeholder="__('Short Name')" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Desc'):</label>
                    <x-core-input name="desc" :value="$electricalequipment->desc" :required="true"
                        :placeholder="__('Desc')" />
                </div>
            </div>
        </div>
    </div>
</div>
