<?php

namespace App\Admin\Enums\Role;

use App\Core\Supports\Enum;

enum RoleManager: int
{
    use Enum;

    case Contract = 10;

    case Customer = 20;
}