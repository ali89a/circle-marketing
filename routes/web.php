<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EnvDynamicController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\Support\StatusController;
use App\Http\Controllers\WorkOrderFilterController;
use App\Http\Controllers\CustomerRelationController;
use App\Http\Controllers\Support\CategoryController;
use App\Http\Controllers\Customer\WorkOrderController;
use App\Http\Controllers\Support\PrioritiesController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Models\SupportTicket;

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
    return redirect('/login');
});

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:admin')->prefix('access-control')->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('admin', AdminController::class);
});
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::resource('user', UserController::class);
    Route::resource('work-order', OrderController::class);
    Route::get('/workorder/cancle-list', [App\Http\Controllers\OrderController::class, 'indexCancle'])->name('cancleList');
    Route::get('/doc-edit', [App\Http\Controllers\OrderController::class, 'docEdit'])->name('doc.edit');
    Route::get('/order-edit', [App\Http\Controllers\OrderController::class, 'orderEdit'])->name('order.edit');
    Route::get('/order-detail-edit', [App\Http\Controllers\OrderController::class, 'orderDetailEdit'])->name('order.detail.edit');

    Route::resource('report', CustomerReportController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('upazila', UpazilaController::class);

    Route::get('/pending-list', [CustomerReportController::class, 'pendingList'])->name('pendingList');
    Route::get('fetch-district', [App\Http\Controllers\OrderController::class, 'fetch_district']);
    Route::get('fetch-district-by-division-id/{id}', [App\Http\Controllers\OrderCustomerInfoController::class, 'fetch_district']);
    Route::get('fetch-upazila-by-district-id/{id}', [App\Http\Controllers\OrderCustomerInfoController::class, 'fetch_upazila']);
    Route::get('fetch-thana', [App\Http\Controllers\OrderController::class, 'fetch_thana']);
    Route::resource('env-dynamic', EnvDynamicController::class);
    Route::get('/doc-edit/{id?}', [App\Http\Controllers\OrderCustomerDocumentController::class, 'docEdit'])->name('docEdit');
    Route::put('/doc-update/{id?}', [App\Http\Controllers\OrderCustomerDocumentController::class, 'docUpdate'])->name('docUpdate');
    Route::get('/order-edit/{id?}', [App\Http\Controllers\OrderController::class, 'orderEdit'])->name('orderEdit');
    Route::get('/order-detail-edit/{id?}', [App\Http\Controllers\OrderController::class, 'orderDetailEdit'])->name('orderDetailEdit');
    Route::get('/fetch-service-by-id/{id?}', [App\Http\Controllers\ServiceController::class, 'fetchService'])->name('fetchService');
    Route::get('/fetch-general-product-info/{id}', [App\Http\Controllers\ServiceController::class, 'fetch_general_product_info'])->name('fetch_general_product_info');
    Route::get('/customer-detail-edit/{id?}', [App\Http\Controllers\OrderCustomerInfoController::class, 'customerDetailEdit'])->name('customerDetailEdit');
    Route::put('/customer-detail-update/{id?}', [App\Http\Controllers\OrderCustomerInfoController::class, 'customerDetailUpdate'])->name('customerDetailUpdate');
    
    Route::put('/order-detail-update/{id?}', [App\Http\Controllers\OrderController::class, 'orderDetailUpdate'])->name('orderDetailUpdate');
    Route::get('/order-cancle/{id?}', [App\Http\Controllers\OrderController::class, 'orderCancle'])->name('orderCancle');

    Route::get('/noc-edit/{id?}', [App\Http\Controllers\OrderNocController::class, 'nocEdit'])->name('nocEdit');
    Route::put('/noc-update/{id?}', [App\Http\Controllers\OrderNocController::class, 'nocUpdate'])->name('nocUpdate');

    Route::post('/modify-description/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'modifyDescription'])->name('modifyDescription');
    Route::post('/comments/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'comment'])->name('comment');

    Route::get('/work-order-upgration/{id?}', [App\Http\Controllers\OrderUpgrationController::class, 'orderUpgration'])->name('work-order-upgration');
    Route::put('/work-order-upgration-update/{id?}', [App\Http\Controllers\OrderUpgrationController::class, 'orderUpgrationUpdate'])->name('orderUpgrationUpdate');

    Route::get('/work-order-downgration/{id?}', [App\Http\Controllers\OrderDowngrationController::class, 'orderDowngration'])->name('work-order-downgration');
    Route::put('/work-order-downgration-update/{id?}', [App\Http\Controllers\OrderDowngrationController::class, 'orderDowngrationUpdate'])->name('orderDowngrationUpdate');

    Route::get('/work-order-marketing-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalMarketing'])->name('workOrderApprovalMarketing');
    Route::get('/work-order-account-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalAccount'])->name('workOrderApprovalAccount');
    Route::get('/work-order-coo-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalCOO'])->name('workOrderApprovalCOO');
    Route::post('/noc-assign', [App\Http\Controllers\OrderApprovalController::class, 'nocAssign'])->name('nocAssign');
    Route::get('/work-order-noc-approval/{id?}', [App\Http\Controllers\OrderApprovalController::class, 'workOrderApprovalNoc'])->name('workOrderApprovalNoc');
    
    Route::get('/invoice-noc-approval/{id?}', [App\Http\Controllers\InvoiceApprovalController::class, 'invoiceApprovalNOC'])->name('invoiceApprovalNOC');
    Route::get('/invoice-marketing-approval/{id?}', [App\Http\Controllers\InvoiceApprovalController::class, 'invoiceApprovalMarketing'])->name('invoiceApprovalMarketing');
    Route::get('/invoice-accounts-approval/{id?}', [App\Http\Controllers\InvoiceApprovalController::class, 'invoiceApprovalAccounts'])->name('invoiceApprovalAccounts');
    Route::get('/invoice-coo-approval/{id?}', [App\Http\Controllers\InvoiceApprovalController::class, 'invoiceApprovalCOO'])->name('invoiceApprovalCOO');


    Route::get('/search-order-result', [WorkOrderFilterController::class, 'searchOrderResult'])->name('searchOrderResult');
    Route::get('/pending-work-order/{keyword}', [WorkOrderFilterController::class, 'pendingWorkOrdersearch']);

    Route::get('/invoices/{id?}', [App\Http\Controllers\InvoiceController::class, 'Invoices'])->name('invoices');
    Route::get('/invoice/details/{id?}', [App\Http\Controllers\InvoiceController::class, 'invoiceDetails'])->name('InvoiceDetails');

    Route::get('/approve/{id?}', [CustomerReportController::class, 'approve'])->name('approve');
    Route::get('/cancel/{id?}', [CustomerReportController::class, 'cancel'])->name('cancel');
    Route::get('/followup', [CustomerReportController::class, 'followUp'])->name('followUp');
    Route::get('/fetch-report-id/{id}', [CustomerReportController::class, 'fetchAll']);
    Route::post('/report-update', [CustomerReportController::class, 'update'])->name('reportUpdate');
    Route::get('/fetch-district-id/{id}', [CustomerReportController::class, 'allUpazila']);
    Route::get('/search-result', [CustomerReportController::class, 'searchResult'])->name('searchResult');
    Route::get('/pending-search-result', [CustomerReportController::class, 'pendingSearchResult'])->name('pendingSearchResult');
    Route::get('/marketing-work-limit', [CustomerReportController::class, 'marketingWorkLimit'])->name('marketingWorkLimit');
    Route::post('/store-work-limit', [CustomerReportController::class, 'storeWorkLimit'])->name('storeWorkLimit');
    Route::get('/marketing-report-analysis', [CustomerReportController::class, 'marketingReportAnalysis'])->name('marketingReportAnalysis');
    Route::get('/report-analysis-result', [CustomerReportController::class, 'reportAnalysisResult'])->name('reportAnalysisResult');

    Route::resource('customer-relation', CustomerRelationController::class);
    Route::get('/crm-work-limit', [CustomerRelationController::class, 'crmWorkLimit'])->name('customerWorkLimit');
    Route::post('/store-crm-work-limit', [CustomerRelationController::class, 'storeWorkLimit'])->name('crmWorkLimit');
    Route::get('/crm-work-analysis', [CustomerRelationController::class, 'crmWorkAnalysis'])->name('customerWorkAnalysis');
    Route::get('/crm-analysis-result', [CustomerRelationController::class, 'crmAnalysisResult'])->name('crmResult');
    Route::get('/crm-search-result', [CustomerRelationController::class, 'crmSearchResult'])->name('crmSearchResult');
    Route::get('/crm-reiewv/{id}', [CustomerRelationController::class, 'review'])->name('crmReview');
    Route::get('/crm-modify/{id}', [CustomerRelationController::class, 'edit'])->name('crmModify');
    Route::get('/print-report', [CustomerReportController::class, 'indexPrint'])->name('printReport');

    Route::resource('support-ticket',SupportTicketController::class);
    Route::resource('support-category',CategoryController::class);
    Route::resource('support-priorities',PrioritiesController::class);
    Route::resource('support-status',StatusController::class);

    Route::get('view-ticket/{id}',[SupportTicketController::class,'view-details'])->name('view-ticket');
});



Route::middleware('auth')->prefix('customer')->name('customer.')->group(function () {

    Route::resource('order', WorkOrderController::class);
    Route::get('/customer-detail-edit/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'customerDetailEdit'])->name('customerDetailEdit');
    Route::get('fetch-district-by-division-id/{id}', [App\Http\Controllers\OrderCustomerInfoController::class, 'fetch_district']);
    Route::get('fetch-upazila-by-district-id/{id}', [App\Http\Controllers\OrderCustomerInfoController::class, 'fetch_upazila']);
    Route::put('/customer-detail-update/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'customerDetailUpdate'])->name('customerDetailUpdate');

    Route::get('/doc-edit/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'docEdit'])->name('docEdit');
    Route::put('/doc-update/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'docUpdate'])->name('docUpdate');

    Route::get('/order-edit/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'orderEdit'])->name('orderEdit');
    Route::get('/order-detail-edit/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'orderDetailEdit'])->name('orderDetailEdit');
    Route::put('/order-detail-update/{id?}', [App\Http\Controllers\Customer\WorkOrderController::class, 'orderDetailUpdate'])->name('orderDetailUpdate');
    Route::get('/fetch-service-by-id/{id?}', [App\Http\Controllers\ServiceController::class, 'fetchService']);
    Route::get('/fetch-general-product-info/{id}', [App\Http\Controllers\ServiceController::class, 'fetch_general_product_info']);


    Route::get('fetch-district', [App\Http\Controllers\OrderController::class, 'fetch_district']);
    Route::get('fetch-thana', [App\Http\Controllers\OrderController::class, 'fetch_thana']);

    // Route::get('ticketlist',[SupportTicket::class,'index'])->name('ticketlist');

    Route::resource('support-ticket',SupportTicketController::class);
});

require('admin.php');