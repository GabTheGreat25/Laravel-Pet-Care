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
// Route::get("/service/destroy/{id}", [
//     "uses" => "ServiceController@destroy",
//     "as" => "service.destroy",
// ]);
Route::get('/services', [
    'uses' => 'ServiceController@getService',
    'as' => 'getService',
]);
Route::post('/service/import', 'ServiceController@import')->name('serviceImport');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
