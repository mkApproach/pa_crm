<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
/*
Route::get('/home', [HomeController::class, 'index'])->name('home');
*/


Route::get('/', 'TopPageController@top_page')->name('top');

Route::get('/customers/json', 'CustomersController@json');
/*
Route::get('/', [App\Http\Controllers\TopPageController::class, 'top_page'])->name('top_page');
*/
Route::get('/users', UserController::class)->name('社員一覧')->middleware('auth');

Route::get('/roles', RoleController::class)->name('ロール一覧')->middleware('auth');

Route::resource('/customers', CustomerController::class)->middleware('auth');

Route::get('/customer_search', 'CustomerSearchController@index')->middleware('auth');
Route::post('/customer_search', 'CustomerSearchController@search')->middleware('auth');

Route::post('/customers/{customer}/logs', 'CustomerLogController')->middleware('auth');
/*
Auth::routes();
*/
Route::get('/home', 'HomeController@index')->name('home');
