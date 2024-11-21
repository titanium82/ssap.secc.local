<span @class([
    'badge', App\Admin\Enums\ExhibitionEvent\EventStatus::from($status)->badge()
])>
    {{ App\Admin\Enums\ExhibitionEvent\EventStatus::from($status)->description() }}
</span>
