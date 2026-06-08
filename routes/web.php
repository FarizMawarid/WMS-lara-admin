<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RackController;


Auth::routes();

Route::get('/', function () {
    return view('vendor.adminlte.auth.login');
});

Route::get('/register', function () {
    return view('vendor.adminlte.auth.register');
});

//Home
Route::get('/admin/home', function () {
    return view('home');
});

//Finish Goods

//Transaction
Route::get('/admin/finish-goods-manual', function () {
    return view('pages.user.transaction.finishgoods.transactionIn');
});

Route::get('/admin/finish-goods-barcode', function () {
    return view('pages.user.transaction.finishgoods.transactionInBarcode');
});

Route::get('/admin/finish-goods-barcode-transaction', function () {
    return view('pages.user.transaction.finishgoods.transactionInBarcode2');
});


//Report
Route::get('/admin/finish-goods-reportIn', function () {
    return view('pages.user.report.finishgoods.finishGoodsReportIn');
});

Route::get('/admin/finish-goods-reportOut', function () {
    return view('pages.user.report.finishgoods.finishGoodsReportOut');
});

route::get('/admin/finish-goods-reportSummary', function () {
    return view('pages.user.report.finishgoods.finishGoodsReportSummary');
});

//Master Data
Route::get('/admin/product-type', function () {
    return view('pages.user.master-data.product-type');
});

//Dashboard
route::get('/admin/finish-goods-dashboard', function () {
    return view('pages.user.dashboard.dashboardFinishGoods');
});

//Admin
Route::get('/admin/user-management', function () {
    return view('pages.admin.userManagement');
});

Route::get('/admin/token-management', function () {
    return view('pages.admin.tokenManagement');
});

Route::get('/admin/rack-management',
    [RackController::class,'index']
);

Route::post('/admin/rack-management',
    [RackController::class,'store']
);

Route::delete('/admin/rack-management/{id}',
    [RackController::class,'destroy']
);
