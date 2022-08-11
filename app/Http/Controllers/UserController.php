<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Order;
use App\Models\admins;
use App\Events\SendMail;
use Event;

class UserController extends Controller
{

    public function __construct(){
        $this->total = 0;
    }

    // public function getSignup(){
    //     return view('user.signup');
    // }

    // public function postSignup(Request $request)
    // {
    //     //
    //     // $this->validate($request, [
    //     //     'email' => 'email| required| unique:users',
    //     //     'password' => 'required| min:4'
    //     // ]);
        
    //     // if($request->role == 'admin'){
    //     //     $user = new User();
    //     //     $user->userName = $request->input("username");
    //     //     $user->role = $request->input("role");
    //     //     $user->email = $request->input("email");
    //     //     $user->password = bcrypt($request->input('password'));
    //     //     // $lastinsertedid=$user->id;
    //     //     $user->save();
    //     //     Auth::login($user);
    //     //     return redirect()->route('admin.registers');

    //     //     } else if($request->role == 'employee'){
    //     //         $user = new User();
    //     //         $user->userName = $request->input("username");
    //     //         $user->role = $request->input("role");
    //     //         $user->email = $request->input("email");
    //     //         $user->password = bcrypt($request->input('password'));
    //     //         // $lastinsertedid=$user->id;
    //     //         $user->save();
    //     //         Auth::login($user);
    //     //         return redirect()->route('employee.registers');


    //     //      } else if($request->role == 'customer'){
    //             // $user = new User();
    //             // $user->userName = $request->input("username");
    //             // $user->role = 'customer';
    //             // $user->email = $request->input("email");
    //             // $user->password = bcrypt($request->input('password'));
    //             // // $lastinsertedid=$user->id;
    //             // $user->save();

    //             // $this->validate($request, [
    //             //     'title' =>'required|regex:/^[a-zA-Z\s]*$/', 
    //             //     'firstName'=>'required|regex:/^[a-zA-Z\s]*$/',
    //             //     'lastName'=>'required|regex:/^[a-zA-Z\s]*$/',
    //             //     'age'=>'required|numeric',
    //             //     'address'=>'required|regex:/^[a-zA-Z\s]*$/',
    //             //     'sex'=>'required|regex:/^[a-zA-Z\s]*$/',
    //             //     'phonenumber'=>'required|numeric',
    //             //     'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
    //             // ]);
        
    //             // $customer = new customer();
              
    //             //     $customer->user_id = $user->id;
    //             //     //User::latest()->pluck('id')->first();
    //             //     // dd(User::latest()->pluck('id')->first());
    //             //     $customer->title = $request->input("title");
    //             //     $customer->firstName = $request->input("firstName");
    //             //     $customer->lastName = $request->input("lastName");
    //             //     $customer->age = $request->input("age");
    //             //     $customer->address = $request->input("address");
    //             //     $customer->sex = $request->input("sex");
    //             //     $customer->phonenumber = $request->input("phonenumber");
        
    //             // if ($file = $request->hasfile("img_path")) {
    //             //     $file = $request->file("img_path");
    //             //     $filename =  $file->getClientOriginalName();
    //             //     $destinationPath = public_path() . '/images/customers';
    //             //     $customer->img_path = '/images/customers/' . $filename;   
    //             //     $file->move($destinationPath,$filename); 
    //             // }
        
    //             // $customer->save();
    //             // Event::dispatch(new SendMail($customer));   
    //             // Auth::login($user);
    //             // return redirect()->route('customer.profile');
    //             // return redirect()->route('customer.registers');
    //     //      } 
            
    //     // else{
    //     //     return view('home');
    //     //     }

    //     // elseif($request->Role == 'NOT-APPROVED'){
    //     //         // your code
    //     //     }

    // }

    public function getSignin(){
        return view('user.signin');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
