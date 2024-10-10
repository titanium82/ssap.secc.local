<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PolicyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Gate::policy(\App\Models\ContractPayment::class, \App\Policies\ContractPaymentPolicy::class);
        Gate::policy(\App\Models\Contract::class, \App\Policies\ContractPolicy::class);
        Gate::policy(\App\Models\Customer::class, \App\Policies\CustomerPolicy::class);
        Gate::policy(\App\Models\CustomerContact::class, \App\Policies\CustomerContactPolicy::class);
    }
}
