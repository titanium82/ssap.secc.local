<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <div class="col-12 mb-3">
                <label class="form-label">@lang('Fullname Customer'):</label>
                <x-core-input name="customer_id" :value="$customer_contact->customer?->fullname" readonly />
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Fullname Contact'):</label>
                    <x-core-input name="fullname" :value="$customer_contact->fullname" :required="true"
                        :placeholder="__('Fullname Contact')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Phone'):</label>
                    <x-core-input-phone name="phone" :value="$customer_contact->phone" :placeholder="__('Phone')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Phone second'):</label>
                    <x-core-input-phone name="phone_second" :value="$customer_contact->phone_second" :placeholder="__('Phone second')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Phone third'):</label>
                    <x-core-input-phone name="phone_third" :value="$customer_contact->phone_third" :placeholder="__('Phone third')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Email'):</label>
                    <x-core-input name="email" :value="$customer_contact->email" :placeholder="__('Email')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Position'):</label>
                    <x-core-input name="position" :value="$customer_contact->position" :placeholder="__('Position')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">@lang('Birthday'):</label>
                    <x-core-input type="date" name="birthday" :value="$customer_contact->birthday" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">@lang('Gender'):</label>
                <x-core-select name="gender" :required="true">
                    @foreach ($gender as $key => $value)
                        <x-core-select-option :option="$customer_contact->gender->value" :value="$key" :title="$value" />
                    @endforeach
                </x-core-select>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">@lang('Desc'):</label>
                    <textarea name="desc" class="form-control" :required="true">{{ $customer_contact->desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>