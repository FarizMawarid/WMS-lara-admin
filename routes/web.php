<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\FinishGoodsTransactionController;

Auth::routes([
    'register' => false,
]);

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin/home');
    }
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('/admin/home', function () {
        return view('home');
    });

    // Transaction
    Route::get('/admin/finish-goods-manual', [FinishGoodsTransactionController::class, 'indexIn']);
    Route::post('/admin/finish-goods-manual', [FinishGoodsTransactionController::class, 'storeIn']);

    Route::get('/admin/finish-goods-barcode', function () {
        return view('pages.user.transaction.finishgoods.transactionInBarcode');
    });

    Route::get('/admin/finish-goods-barcode-transaction', function () {
        return view('pages.user.transaction.finishgoods.transactionInBarcode2');
    });

    Route::get('/admin/finish-goods-out', [FinishGoodsTransactionController::class, 'indexOut']);
    Route::post('/admin/finish-goods-out', [FinishGoodsTransactionController::class, 'storeOut']);

    // Report
    Route::get('/admin/finish-goods-reportIn', [FinishGoodsTransactionController::class, 'reportIn']);
    Route::get('/admin/finish-goods-reportOut', [FinishGoodsTransactionController::class, 'reportOut']);
    Route::get('/admin/finish-goods-reportSummary', [FinishGoodsTransactionController::class, 'reportSummary']);

    // Dashboard
    Route::get('/admin/finish-goods-dashboard', function () {
        return view('pages.user.dashboard.dashboardFinishGoods');
    });

    //Product type
    Route::get(
    '/admin/product-type',
    [ProductTypeController::class,'index']
    );

    Route::post(
    '/admin/product-type',
    [ProductTypeController::class,'store']
    );

    Route::post('/admin/product-type/import', [ProductTypeController::class, 'import'])
    ->name('product-type.import');

    Route::get('/admin/product-type/template', [ProductTypeController::class, 'downloadTemplate'])
    ->name('product-type.template');

    Route::put(
    '/admin/product-type/{id}',
    [ProductTypeController::class,'update']
    );

    Route::delete(
    '/admin/product-type/{id}',
    [ProductTypeController::class,'destroy']
    );

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
