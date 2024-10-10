<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    public function index(): View
    {
        return view('admin.auth.change-password', [
            'breadcrums' => $this->breadcrums()->add(__('passwordChange'))
        ]);
    }

    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        auth('admin')->user()->update([
            'password' => bcrypt($request->input('password'))
        ]);
        
        return back()->with('success', __('notifySuccess'));
    }
}
