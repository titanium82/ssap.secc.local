<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('admin.login.index');
});
