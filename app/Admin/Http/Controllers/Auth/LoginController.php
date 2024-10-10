<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.auth.login');
    }

    public function handle(LoginRequest $request): RedirectResponse
    {
        if($this->resolve($request->validated()))
        {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('LoginFail'));
    }

    protected function resolve($data): bool
    {
        return Auth::guard('admin')->attempt($data, true) ? true : false;
    }
}
