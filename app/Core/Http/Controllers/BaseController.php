<?php

namespace App\Core\Http\Controllers;

use App\Core\Supports\Breadcrums;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * array chứa $breadcrums
     *
     * @var Breadcrums
     */
    protected Breadcrums $breadcrums;
}
