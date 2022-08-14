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
        Route::get("data", [
        "uses" => 'App\Http\Controllers\TransactionController@getData',
        "as" => "transaction.data",
        ]);

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/comments/viewComment/{id}',[
    'uses' => 'CommentController@viewComment',
    'as' => 'comments.viewComment'
]);

Route::post('/comments/updateComment/{id}', [
'uses' => 'CommentController@updateComment',
'as' => 'comments.updateComment',
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('view-comment/{id}',[
//         'uses' => 'CommentController@viewComment',
//         'as' => 'comment.viewComment'
//     ]);

Route::resource('comment', 'CommentController')->middleware('auth');



// Route::get('/comments/viewComment/{id}',['uses' => 'CommentController@viewComment','as' => 'comments.viewComment']);
// Route::post('/comments/updateComment/{id}',['uses' => 'CommentController@updateComment','as' => 'comments.updateComment']);

    // Route::get('/comments/create', [
    //     'uses' => 'CommentController@updateComment',
    //     'as' => 'comment.addComment'
    // ]);

    // Route::get('/shop', [
    //     "uses" => 'App\Http\Controllers\TransactionController@getData',
    //     "as" => "transaction.data",
    //     ]);
    Route::post('/petsearch',['uses' => 'petSearchController@petsearch','as' => 'petsearch'] );
       // Route::post('/transactionsearch',['uses' => 'transactionSearchController@transactionsearch','as' => 'transactionsearch'] );

        Route::post('/transactionsearch', [
            'uses' => 'transactionSearchController@transactionsearch',
            'as' => 'transactionsearch',
        ]);


        Route::get('show-animal/{id}', [
            'uses' => 'ConsultationController@show',
             'as' => 'getanimalconsult'
          ]);

        Route::get('show-customer/{id}', [
            'uses' => 'TransactionController@show',
             'as' => 'getcustomertransac'
          ]);
          
Route::group(['middleware' => 'guest'], function() {

        Route::resource("/service", ServiceController::class)->except(['index', 'service']);

          Route::get('signup', [
          'uses' => 'userController@getSignup',
          'as' => 'user.signups',
              ]);

              Route::get('signup', [
                'uses' => 'userController@getSignup',
                'as' => 'user.signups',
                    ]);

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

        Route::get('customerregister', [
                'uses' => 'CustomerController@getregister',
                'as' => 'customer.registers',
                    ]);
    
        Route::post('customerregister', [
                        'uses' => 'CustomerController@postregistered',
                        'as' => 'customer.register',
                    ]);

        Route::get('employeeregister', [
                        'uses' => 'EmployeeController@getregister',
                        'as' => 'employee.registers',
                            ]);
            
         Route::post('employeeregister', [
                         'uses' => 'EmployeeController@postregistered',
                         'as' => 'employee.register',
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

    Route::group(['middleware' => 'role:admin,employee'], function() {

    

        Route::resource("/transaction", TransactionController::class);
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

          Route::get('/dashboardtransac', [
            'uses' => 'DashboardController@dashtransac',
             'as' => 'dashboard.groomed'
          ]);
        
          Route::post('/dashboardSearchDate', [
            'uses' => 'DashboardController@searchdate',
             'as' => 'dashboard.searchdate'
          ]);
          
     //  Route::get('/charttransac', 'DashboardController@search')->name('search');

    

        // Route::get('/charttransac', [
        //     'uses' => 'DashboardController@search',
        //      'as' => 'dashboard.transaction'
        //   ]);

        //   Route::post('/charttransac', [
        //     'uses' => 'DashboardController@transaction',
        //      'as' => 'dashboard.transaction'
        //   ]);

      //   Route::post('/charttransacs', 'DashboardController@transaction')->name('search_schedule');


        Route::get('/animal/{search?}', [
            'uses' => 'ConsultationController@index',
             'as' => 'Consultations.index'
          ]);

     
    });

//  ->middleware('auth');

      Route::group(['middleware' => 'role:admin'], function() {
        Route::get('adminProfile', [
            'uses' => 'AdminController@getadminProfile',
            'as' => 'admin.profile',
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
            'uses' => 'EmployeeController@getemployeeProfile',
            'as' => 'employee.profile',
           ]);

  

        // Route::resource("/customer", CustomerController::class, ['except'=>['destroy']]);

        Route::get('/consultations', [
            'uses' => 'ConsultationController@getconsultation',
            'as' => 'getconsultation',
        ]);

        Route::get('/transactions', [
            'uses' => 'TransactionController@getTransaction',
            'as' => 'getTransaction',
        ]);

        // Route::resource("/employee", EmployeeController::class)->except(['index', 'destroy','employee' , 'edit']);
  
    });

    Route::group(['middleware' => 'role:customer'], function() {
        Route::get('customerProfile', [
            'uses' => 'CustomerController@getcustomerProfile',
            'as' => 'customer.profile',
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
            'as' => 'customer.petstoreort',
        ]); 

        Route::get("profileHistory", [
        "uses" => 'App\Http\Controllers\TransactionController@getProfile',
        "as" => "transaction.profile",
        ]);


        Route::get('/export',[
        'uses'=>'TransactionController@export',
        'as' => 'item.export'
        ]);

        Route::get("receipt", [
        "uses" => 'App\Http\Controllers\TransactionController@getReceipt',
        "as" => "transactions.receipt",
        ]);

        Route::get("get-customer-transaction", [
        "uses" => 'App\Http\Controllers\TransactionController@getExport',
        "as" => "transactions.getExport",
        ]);

        Route::get("download-pdf", [
            "uses" => 'App\Http\Controllers\TransactionController@downloadPDF',
            "as" => "transactions.downloadPDF",
            ]);

        Route::get('checkout',[
        'uses' => 'TransactionController@postCheckout',
        'as' => 'checkout',
        'middleware' =>'role:customer' 
        ]);
    
        Route::get("shopping-cart", [ //dito napupunta after makuha data
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

