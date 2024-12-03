<?php

use Illuminate\Support\Facades\Route;

Route::middleware(App\Admin\Http\Middleware\GuestAdminMiddleware::class)->group(function () {

    Route::controller(App\Admin\Http\Controllers\Auth\LoginController::class)
    ->prefix('/login')
    ->name('login.')
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'handle')->name('handle');
    });

});

// Authented Admin routes
Route::middleware([App\Admin\Http\Middleware\AuthAdminMiddleware::class, App\Admin\Http\Middleware\AccessRouteNameMiddleware::class])
->group(function () {

    Route::get('/', function () {
        return to_route('admin.dashboard');
    })->name('home');

    Route::get('/dashboard', [App\Admin\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    //notify
    Route::prefix('/notification')->as('notification.')
    ->controller(App\Admin\Http\Controllers\Notification\NotificationController::class)
    ->group(function () {
        Route::get('/show/{id}', 'show')->name('show');
    });

    //Manager contract
    Route::prefix('/contract')->controller(App\Admin\Http\Controllers\Contract\ContractController::class)
    ->name('contract.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/payment-send-mail/{id}', 'paymentSendMail')->name('payment_send_email');
        Route::post('/payment-send-mail', 'handlePaymentSendMail')->name('handle_payment_send_email');
        Route::get('/share/{id}', 'share')->name('share');
        Route::post('/share', 'handleShare')->name('handle_share');
        Route::get('/create/{customer_id?}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
    });

    //Manager contract payment
    Route::prefix('/contract-payment')->controller(App\Admin\Http\Controllers\Contract\ContractPaymentController::class)
    ->name('contract_payment.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/upload-license/{id}', 'uploadLicense')->name('upload_license');
        Route::put('/handle-upload-license', 'handleUploadLicense')->name('handle_upload_license');
        Route::put('/accept/{id}', 'accept')->name('accept');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/show/{id}', 'show')->name('show');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    //Exhibition Location
    Route::prefix('/exhibition-location')->controller(App\Admin\Http\Controllers\Exhibition\ExhibitionLocationController::class)
    ->name('exhibition_location.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
        Route::get('/show/{id}', 'show')->name('show');
    });

    //Exhibition Event
    Route::prefix('/exhibition-event')->controller(App\Admin\Http\Controllers\Exhibition\ExhibitionEventController::class)
    ->name('exhibition_event.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
        Route::get('/show/{id}', 'show')->name('show');
    });
    //Manager contract type
    Route::prefix('/contract-type')->controller(App\Admin\Http\Controllers\Contract\ContractTypeController::class)
    ->name('contract_type.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    //Manager customer
    Route::prefix('/customer')->controller(App\Admin\Http\Controllers\Customer\CustomerController::class)
    ->name('customer.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/render-contact-dt/{id}', 'renderContactDT')->name('render_contact_dt');
        Route::get('/render-contract-dt/{id}', 'renderContractDT')->name('render_contract_dt');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/import-excel', 'importExcel')->name('import_excel');
        Route::get('/search-select', 'searchSelect')->name('search_select');
    });

    //Manager customer contact
    Route::prefix('/customer-contact')->controller(App\Admin\Http\Controllers\Customer\CustomerContactController::class)
    ->name('customer_contact.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{customer_id?}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    //Manager customer sector
    Route::prefix('/customer-sector')->controller(App\Admin\Http\Controllers\Customer\CustomerSectorController::class)
    ->name('customer_sector.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
    });
    //Manager customer type
    Route::prefix('/customer-type')->controller(App\Admin\Http\Controllers\Customer\CustomerTypeController::class)
    ->name('customer_type.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    //Manager Event Service
    Route::prefix('/event-service')->controller(App\Admin\Http\Controllers\EventService\EventServiceController::class)
    ->name('event_service.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
        Route::get('/show/{id}', 'show')->name('show');
    });
    //Manager Event Service Unit
    Route::prefix('/event-service-unit')->controller(App\Admin\Http\Controllers\EventService\EventServiceUnitController::class)
    ->name('event_service_unit.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
        Route::get('/show/{id}', 'show')->name('show');
    });
    //Manager Event Service Type
    Route::prefix('/event-service-type')->controller(App\Admin\Http\Controllers\EventService\EventServiceTypeController::class)
    ->name('event_service_type.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    //Manager Electrical Equipment
    Route::prefix('/electrical-equipment')->controller(App\Admin\Http\Controllers\ElectricalEquipment\ElectricalEquipmentController::class)
    ->name('electrical_equipment.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/import-excel', 'importExcel')->name('import_excel');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
     //Manager Electrical Equipment Type
     Route::prefix('/electrical-equipment-type')->controller(App\Admin\Http\Controllers\ElectricalEquipment\ElectricalEquipmentTypeController::class)
     ->name('electrical_equipment_type.')
     ->group(function () {
         Route::get('/', 'index')->name('index');
         Route::get('/create', 'create')->name('create');
         Route::post('/store', 'store')->name('store');
         Route::put('/update', 'update')->name('update');
         Route::get('/edit/{id}', 'edit')->name('edit');
         Route::delete('/delete/{id}', 'delete')->name('delete');
     });
     //Manager Warehouse
    Route::prefix('/warehouse')->controller(App\Admin\Http\Controllers\Warehouse\WarehouseController::class)
    ->name('warehouse.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    //Manager Department
    Route::prefix('/department')->controller(App\Admin\Http\Controllers\Admin\DepartmentController::class)
    ->name('department.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    //Manager role admin
    Route::prefix('/role')->controller(App\Admin\Http\Controllers\Role\RoleController::class)
    ->name('role.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    //Manager permission admin
    Route::prefix('/permission')->controller(App\Admin\Http\Controllers\Permission\PermissionController::class)
    ->name('permission.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    //Manager admin
    Route::prefix('/admin')->controller(App\Admin\Http\Controllers\Admin\AdminController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/search-select', 'searchSelect')->name('search_select');
    });

    //auth
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
    ->prefix('/profile')
    ->name('profile.')
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(App\Admin\Http\Controllers\Auth\ChangePasswordController::class)
    ->prefix('/password')
    ->name('password.')
    ->group(function(){
        Route::get('/', 'index')->name('change');
        Route::put('/', 'update')->name('update');
    });

    Route::post('/logout', [App\Admin\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

    //ckfinder
    Route::prefix('/manager-file')->name('ckfinder.')->group(function(){
        Route::any('/connect', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('connector');
        Route::any('/duyet', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('browser');
    });

});
