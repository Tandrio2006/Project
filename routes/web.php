<?php
use App\Http\Controllers\{
    Admin\LoginController,
    Admin\CustomerController,
    Admin\FormController,
};
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'ajaxLogin'])->name('login.ajax');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/login');
    });
    //Customer
    Route::get('/customer/indexcustomer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer-data', [CustomerController::class, 'getCustomerData'])->name('customer.data');
    Route::post('/customer/store', [CustomerController::class, 'addCustomer'])->name('addCustomer');
    Route::put('/customer/updateCustomer/{id}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
    Route::delete('/customer/deleteCustomer/{id}', [CustomerController::class, 'destroyCustomer'])->name('deleteCustomer');
    Route::get('/customer/{id}', [CustomerController::class, 'show']);
    Route::get('/customerdata/export', [CustomerController::class, 'export'])->name('ExportCustomer');
    
    //admin
    Route::get('/admin-data', [CustomerController::class, 'getAdminData'])->name('admin.data');
    Route::post('/admin/store', [CustomerController::class, 'addAdmin'])->name('addAdmin');
    Route::put('/admin/updateAdmin/{id}', [CustomerController::class, 'updateAdmin'])->name('updateAdmin');
    Route::delete('/admin/deleteAdmin/{id}', [CustomerController::class, 'destroyAdmin'])->name('deleteAdmin');
    Route::get('/admin/{id}', [CustomerController::class, 'shows']);
    Route::get('/admindata/exportadmin', [CustomerController::class, 'exportAdmin'])->name('ExportAdmin');

    //form
    // Route::get('/form/indexform', [FormController::class, 'index'])->name('form');
    // Route::get('/reload-captcha' , [FormController::class, 'reloadCaptcha']);
    // Route::post('/form/store' , [FormController::class, 'addForm'])->name('addForm');


});
