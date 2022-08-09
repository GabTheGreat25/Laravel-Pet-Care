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
Route::resource("/transaction", TransactionController::class);

Route::get("receipt", [
    "uses" => 'App\Http\Controllers\TransactionController@getReceipt',
    "as" => "transaction.receipt",
]);

 Route::get('checkout',[
        'uses' => 'TransactionController@postCheckout',
        'as' => 'checkout',
        'middleware' =>'role:customer' //lagay sa reduce & remove
    ]);
    
Route::get("shopping-cart", [
    "uses" => 'App\Http\Controllers\TransactionController@getCart',
    "as" => "transaction.shoppingCart",
]);

 Route::get("add-to-cart/{id}", [
    "uses" => 'App\Http\Controllers\TransactionController@getAddToCart',
    "as" => "transaction.addToCart",
]);

Route::get("add-animal/{id}", [
    "uses" => 'App\Http\Controllers\TransactionController@getAnimal',
    "as" => "transaction.addAnimal",
]);

Route::get("remove/{id}", [
    "uses" => 'App\Http\Controllers\TransactionController@getRemoveItem',
    "as" => "transaction.remove",
]);

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

        Route::post('/petsearch',['uses' => 'petSearchController@petsearch','as' => 'petsearch'] );
      
        Route::resource("/consultation", ConsultationController::class);

        Route::get('/services', [
            'uses' => 'ServiceController@getService',
            'as' => 'getService',
        ]);
        
        Route::get('/employees', [
            'uses' => 'employeeController@getEmployee',
            'as' => 'getEmployee',
        ]);

        Route::get('/animals', [
            'uses' => 'AnimalController@getAnimal',
            'as' => 'getAnimal',
        ]);

        Route::get('/customers', [
            'uses' => 'customerController@getCustomer',
            'as' => 'getCustomer',
        ]);

        Route::get("/customer/restore/{id}", [
            "uses" => "customerController@restore",
            "as" => "customer.restore",
        ]);

        Route::resource("/animal", AnimalController::class)->except(['index','animal']);
        Route::resource("/customer", CustomerController::class);

        Route::post('/animal/import', 'AnimalController@import')->name('animalImport');
        Route::post('/customer/import', 'CustomerController@import')->name('customerImport');
        Route::post('/service/import', 'ServiceController@import')->name('serviceImport');
        Route::post('/employee/import', 'employeeController@import')->name('employeeImport');

        Route::resource("/service", ServiceController::class)->except(['index', 'service']);
        Route::resource("/employee", EmployeeController::class)->except(['index', 'destroy','employee' , 'edit']);

        Route::get('/dashboard', [
            'uses' => 'DashboardController@index',
             'as' => 'dashboard.index'
          ]);

        Route::get('/animal/{search?}', [
            'uses' => 'ConsultationController@index',
             'as' => 'Consultations.index'
          ]);
    });

//  ->middleware('auth');

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

        Route::resource("/employee", EmployeeController::class);

        // Route::resource("/customer", CustomerController::class)->except(['index','customer']);

        Route::get('empoyeeedit', [
            'uses' => 'EmployeeController@edit',
            'as' => 'employees.edit',
           ]);

        Route::post('customerdelete', [
            'uses' => 'CustomerController@destroy',
            'as' => 'customers.destroy',
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

        // Route::resource("/customer", CustomerController::class, ['except'=>['destroy']]);

        Route::get('/consultations', [
            'uses' => 'ConsultationController@getconsultation',
            'as' => 'getconsultation',
        ]);

        // Route::resource("/employee", EmployeeController::class)->except(['index', 'destroy','employee' , 'edit']);
  
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
    
    Route::get('/customer/profile/edit/{id}', [
            'uses' => 'CustomerController@profileedit',
            'as' => 'customer.profileedit',
        ]);

        Route::post('/customer/profile/edit/{id}', [
            'uses' => 'CustomerController@profileupdate',
            'as' => 'customer.postupdate',
        ]); 

        Route::get('/mypets', [
            'uses' => 'AnimalController@getpet',
            'as' => 'animal.getpet',
        ]);

        Route::get('/mypetcreate', [
            'uses' => 'AnimalController@petcreate',
            'as' => 'animal.petcreate',
        ]);

        Route::post('/mypetstore', [
            'uses' => 'AnimalController@petstore',
            'as' => 'customer.petstore',
        ]); 
        
        // Route::resource("/animal", AnimalController::class)->only(['edit','destroy','create','index','animal']);
    });

Route::get('logout',[
    'uses' => 'LoginController@logout',
    'as' => 'user.logout',
    'middleware'=>'auth'
   ]);

  Route::fallback(function () {
      return redirect()->back();
  });

