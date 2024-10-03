<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesReportsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\Login;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('dashboard',[HomeController::class, 'index']);

Route::resource('invoice',InvoicesController::class);
Route::resource('section',SectionController::class);
Route::resource('product',ProductController::class);
Route::get('paid',[InvoicesController::class,'paid'])->name('paid');
Route::get('unpaid',[InvoicesController::class,'unpaid'])->name('unpaid');
Route::get('partial',[InvoicesController::class,'partial'])->name('partial');

Route::get('notification/{id}/{noty}',[InvoiceDetailsController::class, 'notify'])->name('notification');
Route::get('markAsRead',[InvoicesController::class, 'readAll'])->name('readall');
// Route::get('readOne',[InvoicesController::class, 'readOne'])->name('readOne');

Route::get('invoice/delete/{id}',[InvoicesController::class, 'destroy'])->name('delete-invoice');
Route::post('section/{id}',[SectionController::class, 'destroy']);
Route::post('product/{id}',[ProductController::class, 'destroy']);
// Route::post('section/update/{id}',[SectionController::class, 'update'])->name('update');
Route::get('section/{id}',[SectionController::class, 'edit'])->name('edit');

Route::get('sections/{id}',[InvoicesController::class,'getProduct']);
Route::get('invoices/invoices_details/{id}',[InvoiceDetailsController::class, 'edit'])->name('editInvoices');

// Route::get('nvoices/invoices_details/download/{invoiceNumber}/{fileName}',[InvoiceDetailsController::class,'openFile'])->name('attach');
// Route::get('nvoices/invoices_details/viewFile/{invoiceNumber}/{fileName}',[InvoiceDetailsController::class,'getFile'])->name('attachGet');


Route::get('printInvoice/{id}',[InvoicesController::class, 'print'])->name('print');

Route::get('nvoices/invoices_details/{invoice_number}/{file_name}',[InvoiceDetailsController::class,'showPdf'])->name('pdf');
Route::get('status_show/{id}',[InvoicesController::class,'show'])->name('status');
Route::post('status/{id}',[InvoicesController::class, 'update'])->name('status.update');


Route::get('reports',[InvoicesReportsController::class, 'index'])->name('reports');
Route::get('customers',[InvoicesReportsController::class, 'show'])->name('customers');
Route::post('customers',[InvoicesReportsController::class, 'customers'])->name('customers');
Route::post('reports/search',[InvoicesReportsController::class, 'search'])->name('search-invoice');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);

});
require __DIR__.'/auth.php';

Route::get('/{page}',[AdminController::class, 'index']);
