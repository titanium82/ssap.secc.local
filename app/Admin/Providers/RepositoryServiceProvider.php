<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Admin\Repositories\Admin\AdminRepositoryInterface'                     => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\Permission\PermissionRepositoryInterface'           => 'App\Admin\Repositories\Permission\PermissionRepository',
        'App\Admin\Repositories\Role\RoleRepositoryInterface'                       => 'App\Admin\Repositories\Role\RoleRepository',
        'App\Admin\Repositories\Customer\CustomerRepositoryInterface'               => 'App\Admin\Repositories\Customer\CustomerRepository',
        'App\Admin\Repositories\Customer\CustomerTypeRepositoryInterface'           => 'App\Admin\Repositories\Customer\CustomerTypeRepository',
        'App\Admin\Repositories\Customer\CustomerSectorRepositoryInterface'         => 'App\Admin\Repositories\Customer\CustomerSectorRepository',
        'App\Admin\Repositories\Customer\CustomerContactRepositoryInterface'        => 'App\Admin\Repositories\Customer\CustomerContactRepository',
        'App\Admin\Repositories\Contract\ContractRepositoryInterface'               => 'App\Admin\Repositories\Contract\ContractRepository',
        'App\Admin\Repositories\Contract\ContractPaymentRepositoryInterface'        => 'App\Admin\Repositories\Contract\ContractPaymentRepository',
        'App\Admin\Repositories\Contract\ContractTypeRepositoryInterface'           => 'App\Admin\Repositories\Contract\ContractTypeRepository',
        'App\Admin\Repositories\EventService\EventServiceTypeRepositoryInterface'   => 'App\Admin\Repositories\EventService\EventServiceTypeRepository',
        'App\Admin\Repositories\EventService\EventServiceRepositoryInterface'       => 'App\Admin\Repositories\EventService\EventServiceRepository',
        'App\Admin\Repositories\EventService\EventServiceUnitRepositoryInterface'   => 'App\Admin\Repositories\EventService\EventServiceUnitRepository',
        'App\Admin\Repositories\Department\DepartmentRepositoryInterface'           => 'App\Admin\Repositories\Department\DepartmentRepository',
        'App\Admin\Repositories\Exhibition\ExhibitionEventRepositoryInterface'      => 'App\Admin\Repositories\Exhibition\ExhibitionEventRepository',
        'App\Admin\Repositories\Exhibition\ExhibitionLocationRepositoryInterface'   => 'App\Admin\Repositories\Exhibition\ExhibitionLocationRepository',

    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
        foreach ($this->repositories as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
