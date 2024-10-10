<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Role name'):</label>
                    <x-core-input name="role[name]" :value="$role->name" :required="true"
                        :placeholder="__('Role name')" />
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">@lang('Permissions list'):</label>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-12 col-md-4">
                            <x-core-input-switch name="permissions[]" :checked="$role_has_permissions" value="{{ $permission->id }}" :label="$permission->name" />    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>