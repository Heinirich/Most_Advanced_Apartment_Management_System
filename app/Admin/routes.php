<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    /**
     * All Tenants Routes
     */
    $router->resource('tenants', TenantsController::class);
    /**
     * All Announcements Routes
     */
    $router->resource('announcements', AnnouncementController::class);
    /**
     * All Rooms Routes
     */
    $router->resource('rooms', RoomController::class);
    /**
     * All MPESA Routes
     */
    $router->resource('mpesa-transactions', MpesaTransactionController::class);
    /**
     * All Compains Routes
     */
    $router->resource('complains', ComplainController::class);
     /**
     * Maintenances Payment History
     */
    $router->resource('maintenances', MaintenanceController::class);
    /**
     * Rent Collections History
     */
    $router->resource('rent-collections', RentCollectionController::class);
    /**
     * Sms Communication History
     */
    $router->resource('sms-communications', SmsCommunicationController::class);
    /**
     * Room Payment History
     */
    $router->get('/payhistory/{room_id}/room', 'CustomRoutesController@payhistoryroom')->name('payhistoryroom');
});
