<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ExtendBladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::directive('adminaccessroutename', function (string $route_name = null) {
            $route_name = $route_name == '' ? "''" : $route_name;

            return "<?php if(auth('admin')->user()->checkEmptyRouteNameAccessOrSuperAdmin($route_name, true)): ?>";
        });

        Blade::directive('elseadminaccessroutename', function () {
            return '<?php else: ?>';
        });

        Blade::directive('endadminaccessroutename', function () {
            return '<?php endif; ?>';
        });
    }
}