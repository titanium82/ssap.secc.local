<span @class([
    'badge', App\Admin\Enums\Contract\ContractPaymentStatus::from($status)->badge()
])>
    {{ App\Admin\Enums\Contract\ContractPaymentStatus::from($status)->description() }}
</span>