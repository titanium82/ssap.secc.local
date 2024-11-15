<?php

namespace App\Admin\Enums\ExhibitionLocation;

use App\Core\Supports\Enum;

enum EventManager: string
{
    use Enum;
    case ChungTienHoa = 'Chung Tiến Hòa';
    case NgueynThiThanhTien = 'Nguyễn Thị Thanh Tiền';

}
