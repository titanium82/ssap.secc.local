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
        Gate::policy(\App\Models\ExhibitionEvent::class,\App\Policies\ExhibitionEventPolicy::class);
        Gate::policy(\App\Models\ElectricalEquipment::class,\App\Policies\ElectricalEquipmentPolicy::class);
        Gate::policy(\App\Models\ElectricalEquipmentOrder::class,\App\Policies\ElectricalEquipmentOrderPolicy::class);
        Gate::policy(\App\Models\EventService::class,\App\Policies\EventServicePolicy::class);
        Gate::policy(\App\Models\EventServiceUnit::class,\App\Policies\EventServiceUnitPolicy::class);
        Gate::policy(\App\Models\EventServiceType::class,\App\Policies\EventServiceTypePolicy::class);
    }
}
