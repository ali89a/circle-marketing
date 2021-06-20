<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EnvDynamicController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomerReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:admin')->prefix('access-control')->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('admin', AdminController::class);
});
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::resource('user', UserController::class);
    Route::resource('work-order', OrderController::class);
    Route::get('/doc-edit', [App\Http\Controllers\OrderController::class, 'docEdit'])->name('doc.edit');
    Route::get('/order-edit', [App\Http\Controllers\OrderController::class, 'orderEdit'])->name('order.edit');
    Route::get('/order-detail-edit', [App\Http\Controllers\OrderController::class, 'orderDetailEdit'])->name('order.detail.edit');
    
    Route::resource('report', CustomerReportController::class);
   
    Route::get('/pending-list', [CustomerReportController::class, 'pendingList'])->name('pendingList');
    Route::get('fetch-district', [App\Http\Controllers\OrderController::class, 'fetch_district']);
    Route::get('fetch-thana', [App\Http\Controllers\OrderController::class, 'fetch_thana']);
    Route::resource('env-dynamic', EnvDynamicController::class);
    Route::get('/doc-edit/{id?}', [App\Http\Controllers\OrderController::class, 'docEdit'])->name('docEdit');
    Route::put('/doc-update/{id?}', [App\Http\Controllers\OrderController::class, 'docUpdate'])->name('docUpdate');
    Route::get('/order-edit/{id?}', [App\Http\Controllers\OrderController::class, 'orderEdit'])->name('orderEdit');
    Route::get('/order-detail-edit/{id?}', [App\Http\Controllers\OrderController::class, 'orderDetailEdit'])->name('orderDetailEdit');
    Route::get('/fetch-service-by-id/{id?}', [App\Http\Controllers\ServiceController::class, 'fetchService'])->name('fetchService');
    Route::get('/fetch-general-product-info/{id}', [App\Http\Controllers\ServiceController::class, 'fetch_general_product_info'])->name('fetch_general_product_info');
    Route::get('/customer-detail-edit/{id?}', [App\Http\Controllers\OrderController::class, 'customerDetailEdit'])->name('customerDetailEdit');
    Route::put('/customer-detail-update/{id?}', [App\Http\Controllers\OrderController::class, 'customerDetailUpdate'])->name('customerDetailUpdate');
    Route::put('/order-detail-update/{id?}', [App\Http\Controllers\OrderController::class, 'orderDetailUpdate'])->name('orderDetailUpdate');
    Route::get('/work-order-upgration/{id?}', [App\Http\Controllers\OrderController::class, 'orderUpgration'])->name('work-order-upgration');
    Route::get('/work-order-downgration/{id?}', [App\Http\Controllers\OrderController::class, 'orderDowngration'])->name('work-order-downgration');
    Route::get('/work-order-marketing-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalMarketing'])->name('workOrderApprovalMarketing');
    Route::get('/work-order-account-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalAccount'])->name('workOrderApprovalAccount');
    Route::get('/work-order-coo-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalCOO'])->name('workOrderApprovalCOO');
    Route::get('/noc-assign/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'nocAssign'])->name('nocAssign');
    Route::get('/work-order-noc-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalNoc'])->name('workOrderApprovalNoc');
    
    Route::get('/invoices/{id?}', [App\Http\Controllers\InvoiceController::class, 'Invoices'])->name('invoices');
    Route::get('/invoice/details/{id?}', [App\Http\Controllers\InvoiceController::class, 'invoiceDetails'])->name('InvoiceDetails');
   
    Route::get('/approve/{id?}', [CustomerReportController::class, 'approve'])->name('approve');
    Route::get('/cancel/{id?}', [CustomerReportController::class, 'cancel'])->name('cancel');
    Route::get('/followup', [CustomerReportController::class, 'followUp'])->name('followUp');
    Route::get('/fetch-report-id/{id}', [CustomerReportController::class, 'fetchAll']);
    Route::post('/report-update', [CustomerReportController::class, 'update'])->name('reportUpdate');
    Route::get('/fetch-district-id/{id}', [CustomerReportController::class, 'allUpazila']);
    Route::get('/search-result', [CustomerReportController::class, 'searchResult'])->name('searchResult');
});
require('admin.php');