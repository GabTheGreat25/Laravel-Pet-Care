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

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("/service", ServiceController::class)->except(['index', 'service']);
Route::get('/services', [
    'uses' => 'ServiceController@getService',
    'as' => 'getService',
]);
Route::post('/service/import', 'ServiceController@import')->name('serviceImport');

   Route::group(['middleware' => 'guest'], function() {

    Route::resource("/service", ServiceController::class)->except(['index', 'service']);

          Route::get('signup', [
          'uses' => 'userController@getSignup',
          'as' => 'user.signups',
              ]);

          Route::post('signup', [
                  'uses' => 'userController@postSignup',
                  'as' => 'user.signup',
              ]);

          Route::get('signin', [
                  'uses' => 'userController@getSignin',
                  'as' => 'user.signins',
               ]);

          Route::post('signin', [
                  'uses' => 'LoginController@postSignin',
                  'as' => 'user.signin',
              ]);

      });

      Route::group(['middleware' => 'role:admin,employee'], function() {
        Route::resource("/service", ServiceController::class)->except(['index', 'service']);

        Route::get('/services', [
            'uses' => 'ServiceController@getService',
            'as' => 'getService',
        ]);
        
        Route::post('/service/import', 'ServiceController@import')->name('serviceImport');
        
        Route::resource("/employee", EmployeeController::class)->except(['index', 'employee']);
        Route::get('/employees', [
            'uses' => 'employeeController@getEmployee',
            'as' => 'getEmployee',
        ]);
        Route::post('/employee/import', 'employeeController@import')->name('employeeImport');
        
        // Route::resource("/customer", CustomerController::class)->except(['index', 'customer']);
        Route::get('/customers', [
            'uses' => 'customerController@getCustomer',
            'as' => 'getCustomer',
        ]);

        Route::resource("/customer", CustomerController::class)->except(['index', 'customer']);
        
        Route::post('/customer/import', 'CustomerController@import')->name('customerImport');

    });

          Route::group(['middleware' => 'role:admin,employee,customer'], function() {
        
        Route::resource("/animal", AnimalController::class);
        
        Route::get('/animals', [
            'uses' => 'AnimalController@getAnimal',
            'as' => 'getAnimal',
        ]);
        
        Route::post('/animal/import', 'AnimalController@import')->name('animalImport');

    });


      Route::group(['middleware' => 'role:admin'], function() {
        Route::get('adminProfile', [
            'uses' => 'UserController@getadminProfile',
            'as' => 'admin.profile',
           ]);

        Route::get('adminregister', [
            'uses' => 'AdminController@getregister',
            'as' => 'admin.registers',
                ]);

        Route::post('adminregister', [
                    'uses' => 'AdminController@postregistered',
                    'as' => 'admin.register',
                ]);
    });

        Route::group(['middleware' => 'role:employee'], function() {
        Route::get('employeeProfile', [
            'uses' => 'UserController@getemployeeProfile',
            'as' => 'employee.profile',
           ]);

        Route::get('employeeregister', [
            'uses' => 'EmployeeController@getregister',
            'as' => 'employee.registers',
                ]);

        Route::post('employeeregister', [
                    'uses' => 'EmployeeController@postregistered',
                    'as' => 'employee.register',
                ]);
    });

    Route::group(['middleware' => 'role:customer'], function() {
        Route::get('customerProfile', [
            'uses' => 'UserController@getcustomerProfile',
            'as' => 'customer.profile',
           ]);
   
        Route::get('customerregister', [
            'uses' => 'CustomerController@getregister',
            'as' => 'customer.registers',
                ]);

        Route::post('customerregister', [
                    'uses' => 'CustomerController@postregistered',
                    'as' => 'customer.register',
                ]);

                Route::resource("/customer", CustomerController::class)->except(['index', 'customer']);
                
Route::get('/customer/edit/{id}', [
    'uses' => 'CustomerController@getedit',
    'as' => 'customer.profileedit',
        ]);

Route::post('/customer/edit/{id}', [
            'uses' => 'CustomerController@postupdate',
            'as' => 'customer.postupdate',
        ]);



// Route::get('/customer/edit/{id}', 'CustomerController@getedit')->name('customer.profileedit');
// Route::post('/customer/edit/{id}', 'CustomerController@update')->name('customer.update');

    });


    //   Route::group(['middleware' => 'role:admin'], function() {
   
    //   });

// Route::get('/signup', [UserController::class, 'getsignup']);
// Route::post('/signups', [UserController::class, 'postSignup'])->name('user.signup');

// Route::get('/adminreg', [AdminController::class, 'getregister'])->name('aregister');;
// Route::post('/adminregs', [AdminController::class, 'postregistered'])->name('admin.register');

Route::get('logout',[
    'uses' => 'LoginController@logout',
    'as' => 'user.logout',
    'middleware'=>'auth'
   ]);

  Route::fallback(function () {
      return redirect()->back();
  });

    

// Route::post('/adminregs', [UserController::class, 'postSignup'])->name('user.signup');

// Route::post('/signup', [App\Http\Controllers\UserController::class, 'postSignup'])->name('user.signup');

// Route::get('/adminregister', [AdminController::class, 'getregister']);
// Route::post('/adminregisters', [AdminController::class, 'postregistered'])->name('admin.register');

// Route::post('/admin', 'adminController@postregistered');

