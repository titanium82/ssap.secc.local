<?php

return [
    App\Core\Enums\DefaultStatus::class => [
        App\Core\Enums\DefaultStatus::Published->value => 'Đã xuất bản',
        App\Core\Enums\DefaultStatus::Draft->value => 'Bản nháp'
    ],
    App\Core\Enums\Gender::class => [
        App\Core\Enums\Gender::Male->value => 'Ông',
        App\Core\Enums\Gender::Female->value => 'Bà',
        App\Core\Enums\Gender::Mr->value => 'Anh',
        App\Core\Enums\Gender::Ms->value => 'Chị',
        App\Core\Enums\Gender::Other->value => 'Khác'

    ],
    App\Admin\Enums\EventService\Unit::class =>[
        App\Admin\Enums\EventService\Unit::Cable->value => 'Sợi',
        App\Admin\Enums\EventService\Unit::Pieces->value => 'Cái',
        App\Admin\Enums\EventService\Unit::set->value => 'Gói',

    ],
    App\Admin\Enums\Contract\ContractPaymentMethod::class =>[
        App\Admin\Enums\Contract\ContractPaymentMethod::Banking->value => 'Chuyển Khoản',
        App\Admin\Enums\Contract\ContractPaymentMethod::Cash->value => 'Tiền Mặt'
    ],
    App\Admin\Enums\Contract\ContractStatus::class =>[
        App\Admin\Enums\Contract\ContractStatus::Pending->value => "Chờ xác nhận",
        App\Admin\Enums\Contract\ContractStatus::Processing->value => "Đang triển khai",
        App\Admin\Enums\Contract\ContractStatus::Completed->value => "Hoàn Tất"
    ],
    App\Admin\Enums\Contract\ContractPaymentStatus::class =>[
        App\Admin\Enums\Contract\ContractPaymentStatus::Paid->value => "Đã thanh toán",
        App\Admin\Enums\Contract\ContractPaymentStatus::Unpaid->value => "Chưa thanh toán",
        App\Admin\Enums\Contract\ContractPaymentStatus::Late->value => "Trễ hạn thanh toán"
    ],
];
