<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RackController;
use App\Http\Controllers\UserController;

Auth::routes([
    'register' => false,
]);

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('/admin/home', function () {
        return view('home');
    });

    // Transaction
    Route::get('/admin/finish-goods-manual', function () {
        return view('pages.user.transaction.finishgoods.transactionIn');
    });

    Route::get('/admin/finish-goods-barcode', function () {
        return view('pages.user.transaction.finishgoods.transactionInBarcode');
    });

    Route::get('/admin/finish-goods-barcode-transaction', function () {
        return view('pages.user.transaction.finishgoods.transactionInBarcode2');
    });

    Route::get('/admin/finish-goods-out', function () {
        return view('pages.user.transaction.finishgoods.transactionOut');
    });

    // Report
    Route::get('/admin/finish-goods-reportIn', function () {
        return view('pages.user.report.finishgoods.finishGoodsReportIn');
    });

    Route::get('/admin/finish-goods-reportOut', function () {
        return view('pages.user.report.finishgoods.finishGoodsReportOut');
    });

    Route::get('/admin/finish-goods-reportSummary', function () {
        return view('pages.user.report.finishgoods.finishGoodsReportSummary');
    });

    // Master Data
    Route::get('/admin/product-type', function () {
        return view('pages.user.master-data.product-type');
    });

    // Dashboard
    Route::get('/admin/finish-goods-dashboard', function () {
        return view('pages.user.dashboard.dashboardFinishGoods');
    });

});

//Admin
//User Management
Route::middleware(['auth','role:Admin'])->group(function(){

    Route::get('/admin/user-management',
        [UserController::class,'index']);

    Route::post('/admin/user-management',
        [UserController::class,'store']);

    Route::put('/admin/user-management/{id}',
        [UserController::class,'update']);

    Route::delete('/admin/user-management/{id}',
        [UserController::class,'destroy']);

});

//Token management 
Route::middleware(['auth','role:Admin'])->group(function(){

    Route::get('/admin/token-management', function () {
        return view('pages.admin.tokenManagement');
    });

});


//Rack Management
Route::middleware(['auth','role:Admin'])->group(function(){

    Route::get('/admin/rack-management',
        [RackController::class,'index']);

    Route::post('/admin/rack-management',
        [RackController::class,'store']);

    Route::put('/admin/rack-management/{id}',
        [RackController::class,'update']);

    Route::delete('/admin/rack-management/{id}',
        [RackController::class,'destroy']);

});
