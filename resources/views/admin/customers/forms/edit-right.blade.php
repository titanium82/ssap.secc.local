<div class="col-12 col-md-3">
    <div id="blockSubmit" class="card">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <div class="d-flex align-items-center h-100 gap-2">
                <button type="submit" class="btn btn-primary" title="@lang('save')" name="submitter" value="save">@lang('save')</button>
                <button type="submit" class="btn" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </button>
            </div>
            <button type="button" class="btn btn-danger open-modal-delete" data-route="{{ route('admin.customer.delete', $customer->id) }}" data-target="#modalDelete">
                @lang('Delete')
            </button>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            @lang('Logo')
        </div>
        <div class="card-body p-2">
            <x-core-input-image-ckfinder name="logo" showImage="logo" :value="$customer->logo" />
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            @lang('Customer Sector')
        </div>
        <div class="card-body">
            <div class="wrap-list-checkbox">
                @foreach ($sectors as $sector)
                    <x-core-input-checkbox :checked="$customer->sectors->pluck('id')->toArray()" name="customer_sector_id[]" :value="$sector->id" :label="$sector->name" />
                @endforeach
            </div>
        </div>
    </div>
</div>