<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/signup', [UserController::class, 'getsignup']);
Route::post('/signups', [UserController::class, 'postSignup'])->name('user.signup');

Route::get('/adminreg', [AdminController::class, 'getregister'])->name('aregister');;
Route::post('/adminregs', [AdminController::class, 'postregistered'])->name('admin.register');
// Route::post('/adminregs', [UserController::class, 'postSignup'])->name('user.signup');

// Route::post('/signup', [App\Http\Controllers\UserController::class, 'postSignup'])->name('user.signup');

// Route::get('/adminregister', [AdminController::class, 'getregister']);
// Route::post('/adminregisters', [AdminController::class, 'postregistered'])->name('admin.register');

// Route::post('/admin', 'adminController@postregistered');
