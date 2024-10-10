<span @class([
    'badge', App\Admin\Enums\Contract\ContractStatus::from($status)->badge()
])>
    {{ App\Admin\Enums\Contract\ContractStatus::from($status)->description() }}
</span>