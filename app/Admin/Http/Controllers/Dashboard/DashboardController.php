<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // dd(auth('admin')->user()->managerContract());
        // dd(app()->make('App\Admin\Repositories\Contract\ContractPaymentRepositoryInterface')->getLazyByIdDueReminder(1000)->count());
        return view('admin.dashboard.index')->with('breadcrums', $this->breadcrums());
    }
}