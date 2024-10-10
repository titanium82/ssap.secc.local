<?php

namespace App\Admin\Http\Controllers;

use App\Core\Http\Controllers\BaseController;
use App\Core\Supports\Breadcrums;

class Controller extends BaseController
{
    public function breadcrums()
    {
        $this->breadcrums = (new Breadcrums)->addByRouteName('Dashboard', 'admin.dashboard');
        
        return $this->breadcrums;
    }
}