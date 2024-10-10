@extends('admin.layouts.guest.master')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset(config('core.images.logo')) }}" width="110" height="32" alt="K-Tech Admin"
                        class="navbar-brand-image">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">@lang('Login admin')</h2>
                    <x-core-form :action="route('admin.login.handle')" type="post" :validate="true">
                        <div class="mb-3">
                            <label class="form-label">@lang('email'):</label>
                            <x-core-input-email name="email" :required="true" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('password'):</label>
                            <x-core-input-password name="password" :required="true" />
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">@lang('login')</button>
                        </div>
                    </x-core-form>
                </div>
            </div>
        </div>
    </div>
@endsection
