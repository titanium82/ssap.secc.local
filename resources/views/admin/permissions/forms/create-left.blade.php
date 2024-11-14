<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Permission name'):</label>
                    <x-core-input name="name" :value="old('name')" :required="true"
                        :placeholder="__('Permission name')" />
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">@lang('Route list'):</label>
                <div class="row">
                    @foreach ($route_names as $route_name)
                        <div class="col-12 col-md-4">
                            <x-core-input-switch name="route_names[]" value="{{ $route_name }}" :label="$route_name" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>