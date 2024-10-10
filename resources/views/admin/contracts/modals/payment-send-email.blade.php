<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <x-core-form class="ajax-modal-form" action="{{ route('admin.contract.handle_payment_send_email') }}" type="post" :validate="true">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Send mail')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Contract Name'):</label>
                                <x-core-input name="contract" :disabled="true" :value="$contract->name" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Contract Payment'):</label>
                                <x-core-select name="contract_payment_id" :required="true">
                                    @foreach ($contract->payments as $payment)
                                            <x-core-select-option value="{{ $payment->id }}" :title="trans('Period :num', ['num' => $payment->period])" />
                                    @endforeach
                                </x-core-select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Title'):</label>
                                <x-core-input name="title" :required="true"
                                    :placeholder="__('Title')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('List email'):</label>
                                <x-core-input name="email" class="tagify-basic" :placeholder="trans('Enter email...')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">@lang('File'):</div>
                                @foreach (array_merge($contract->annex?->toArray() ?? [], $contract->files?->toArray() ?? []) as $file)
                                    <x-core-input-switch name="files[]" :value="$file" :linkLabel="true" :label="basename($file)" />
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('Content'):</label>
                                <textarea name="content" class="form-control ckeditor"></textarea>
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