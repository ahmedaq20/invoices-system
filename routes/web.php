<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});
Route::get('/home', 'App\Http\Controllers\HomeController@index');



// Route::get('/', function () {
//     return view('auth.register');
// });





Auth::routes();
Route::resource('invoices', 'App\Http\Controllers\AqinvoicesController');
Route::post('invoices', 'App\Http\Controllers\AqinvoicesController@index')->name('invoices.index');
Route::post('invoices/store', 'App\Http\Controllers\AqinvoicesController@store')->name('invoices.store');

Route::put('invoices/update', 'App\Http\Controllers\AqinvoicesController@update')->name('invoices/update');
Route::post('invoices/updateChange', 'App\Http\Controllers\AqinvoicesController@updateChange')->name('invoices/updateChange');
Route::get('MarkAsRead_all', 'App\Http\Controllers\AqinvoicesController@MarkAsRead_all');
Route::get('profile', 'App\Http\Controllers\AqinvoicesController@profile');


Route::get('/section/{id}', 'App\Http\Controllers\AqinvoicesController@getproducts');
// Route::POST('delete/file', 'App\Http\Controllers\AqinvoicesController@destroy')->name('delete.file');

Route::get('/invoicesdetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');
Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');
Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');
Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');


Route::post('InvoiceAttachments/', 'App\Http\Controllers\InvoiceAttachmentsController@store');

Route::get('/invoiceEdit/{id}', 'App\Http\Controllers\AqinvoicesController@edit');
Route::get('/invoiceChange/{id}', 'App\Http\Controllers\AqinvoicesController@change');



Route::get('invoicesPaid', 'App\Http\Controllers\AqinvoicesController@invoicesPaid')->name('invoices.invoicesPaid');

Route::get('invoicesUnpaid', 'App\Http\Controllers\AqinvoicesController@invoicesUnpaid')->name('invoices.invoicesUnpaid');

Route::get('invoicesPaidPartiel', 'App\Http\Controllers\AqinvoicesController@invoicesPaidPartiel')->name('invoices.invoicesPaidPartiel');

Route::get('printinvoive/{id}', 'App\Http\Controllers\AqinvoicesController@printinvoive');

//Excel
Route::get('invoice/export/', [App\Http\Controllers\AqinvoicesController::class, 'export']);

// archiveController
Route::resource('archive', 'App\Http\Controllers\archiveController');


Route::resource('sections', 'App\Http\Controllers\SectionsController');
Route::resource('products', 'App\Http\Controllers\ProductsController');
// Route::get('/products/{id}', 'App\Http\Controllers\ProductsController@edit');

// Route::post('products/update', 'App\Http\Controllers\ProductsController@update');


//ReportInovice
Route::get('/ReportInovice', 'App\Http\Controllers\Invoices_ReportController@index');
Route::post('/Search_invoices', 'App\Http\Controllers\Invoices_ReportController@Search_invoices');

//customers Report Controller
Route::get('/CustomersInovice', 'App\Http\Controllers\CustomersController@index');
Route::post('/CustomersInovice', 'App\Http\Controllers\CustomersController@Search_Customers');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::resource('users','App\Http\Controllers\UserController');
    Route::resource('users/profile','App\Http\Controllers\UserController');

    });

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);




