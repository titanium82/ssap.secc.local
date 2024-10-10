<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" data-load-dt="true" data-table-id="customer_contact" action="{{ route('admin.customer_contact.store') }}" type="post" :validate="true">

                <div class="modal-header">
                    <h5 class="modal-title">@lang('Create contact')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-none">
                        <x-core-input-image-ckfinder name="avatar" showImage="avatar" />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Customer'):</label>
                                @if($customer)
                                    <x-core-input name="customer" :value="$customer->fullname" disabled />
                                    <x-core-input type="hidden" name="customer_id" :value="$customer->id" />
                                @else
                                    <x-core-select class="select2-bs5-ajax-many" name="customer_id" :required="true" :data-url="route('admin.customer.search_select')">
                                    </x-core-select>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Fullname'):</label>
                                <x-core-input name="fullname" :value="old('fullname')" :required="true"
                                    :placeholder="__('Fullname')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Phone'):</label>
                                <x-core-input-phone name="phone" :value="old('phone')" :placeholder="__('Phone')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Phone second'):</label>
                                <x-core-input-phone name="phone_second" :value="old('phone_second')" :placeholder="__('Phone second')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Phone third'):</label>
                                <x-core-input-phone name="phone_third" :value="old('phone_third')" :placeholder="__('Phone third')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Email'):</label>
                                <x-core-input name="email" :value="old('email')" :placeholder="__('Email')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Position'):</label>
                                <x-core-input name="position" :value="old('position')" :placeholder="__('Position')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('Birthday'):</label>
                                <x-core-input type="date" name="birthday" :value="old('birthday')" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">@lang('Gender'):</label>
                            <x-core-select name="gender" :required="true">
                                @foreach ($gender as $key => $value)
                                    <x-core-select-option :value="$key" :title="$value" />
                                @endforeach
                            </x-core-select>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Desc'):</label>
                                <textarea name="desc" class="form-control" :required="true">{{ old('desc') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Send')</button>
                </div>
            </x-core-form>
        </div>
    </div>
</div>