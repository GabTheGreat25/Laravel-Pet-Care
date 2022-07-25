<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource("/service", ServiceController::class)->except(['index', 'service']);
Route::get("/service/restore/{id}", [
    "uses" => "ServiceController@restore",
    "as" => "service.restore",
]);
Route::get("/service/forceDelete/{id}", [
    "uses" => "ServiceController@forceDelete",
    "as" => "service.forceDelete",
]);
Route::get('/services', [
    'uses' => 'ServiceController@getService',
    'as' => 'getService',
]);
Route::get('/service/{search?}', [
    'uses' => 'ServiceController@index',
    'as' => 'service.index',
]);

Route::get('/search/{search?}', ['uses' => 'SearchController@search', 'as' => 'search']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
