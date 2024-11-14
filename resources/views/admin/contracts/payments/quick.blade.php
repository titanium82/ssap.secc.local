<div class="list-group-item item-ct position-relative">
    @if (!isset($contract_payment))
        <button type="button" class="btn btn-sm btn-icon position-absolute top-0 end-0 delete-item-ct"><i class="ti ti-trash"></i></button>
    @endif
    @isset($contract_payment)
        <div class="fw-bold mb-3">
            @adminaccessroutename('admin.contract_payment.edit')
                <a href="{{ route('admin.contract_payment.edit', $contract_payment->id) }}">@lang('Payment period :num', ['num' => $contract_payment->period])</a>
                <span @class(['ms-2 badge', $contract_payment->status->badge()])>{{ $contract_payment->status->description() }}</span>
            @endadminaccessroutename
        </div>
    @endisset
    <div class="mb-3">
        <label class="form-label">@lang('Expired'):</label>
        <x-core-input type="date" 
            name="payment[{{$ct_key}}][expired_at]" 
            :value="isset($contract_payment) ? $contract_payment->expired_at->toDateString() :null" 
            :readonly="isset($contract_payment)" 
            :required="true" 
        />
    </div>
    <div class="mb-3">
        <label class="form-label">@lang('Amount'):</label>
        <x-core-input class="input-format-number" name="payment[{{$ct_key}}][amount]" 
            :value="number_format($contract_payment->amount ?? null)" 
            :readonly="isset($contract_payment)" 
            :required="true" 
            :placeholder="trans('Amount')"
        />
    </div>
    <div class="mb-3">
        @if(isset($contract_payment))
            @if($contract_payment->file_send_mail)
                <a href="{{ asset($contract_payment->file_send_mail) }}" target="_blank">@lang('File send mail')</a>
            @endif
        @else
            <label class="form-label">@lang('File send mail'):</label>
            <x-core-input-file-pond name="payment[{{$ct_key}}][file_send_mail]" :value="$contract_payment->file_send_mail ?? null"  style="opacity: 0" />
        @endif
    </div>
</div>