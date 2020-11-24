<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('public.home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes([
    'confirm' => false,
    'forgot' => false,
    'login' => true,
    'register' => false,
    'reset' => false,
    'verification' => false,
]);

// Касса
Route::prefix('cashbox')->middleware('admin_auth')->group(function (){
    //    После добавления маршрута необходимо создать разрешения для этого маршрута в
//    \App\Http\Middleware\CheckPermissions::class и в базе данных(или в сиде RolesAndPermissionsSeeder.php)

    Route::get('form/{id?}', 'Cashbox\CashboxController@index')->name('cashbox.index');
    Route::get('show', 'Cashbox\CashboxController@show')->name('cashbox.show');
    Route::post('store', 'Cashbox\CashboxController@store')->name('cashbox.store');
});


// Админка
Route::prefix('admin')->middleware('admin_auth')->group(function() {
//    После добавления маршрута необходимо создать разрешения для этого маршрута в
//    \App\Http\Middleware\CheckPermissions::class и в базе данных(или в сиде RolesAndPermissionsSeeder.php)

    Route::resource('fuel', 'Admin\FuelController')->names('admin.fuel');
    Route::resource('column', 'Admin\ColumnController')->except('show')->names('admin.column');
    Route::resource('order', 'Admin\OrderController')->except('show')->names('admin.order');

    Route::resource('/', 'Admin\DashboardController')
        ->only(['index'])->names('admin.dashboard');

    Route::resource('user', 'Admin\UserController')
        ->names('admin.user');

    Route::resource('permission', 'Admin\PermissionController')
        ->except(['create', 'store', 'destroy'])->names('admin.permission');

    Route::resource('role', 'Admin\RoleController')
        ->names('admin.role');

    Route::resource('user_role', 'Admin\UserRoleController')
        ->only(['index','show','edit','update'])->names('admin.user_role');
});

