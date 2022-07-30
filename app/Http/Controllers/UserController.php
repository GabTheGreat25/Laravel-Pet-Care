<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Order;
use App\Models\admins;

class UserController extends Controller
{

    public function __construct(){
        $this->total = 0;
    }

    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        //
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);
        
        if($request->role == 'admin'){
            $user = new User();
            $user->userName = $request->input("username");
            $user->role = $request->input("role");
            $user->email = $request->input("email");
            $user->password = bcrypt($request->input('password'));
            // $lastinsertedid=$user->id;
            $user->save();
            Auth::login($user);
            return redirect()->route('admin.registers');

            } else if($request->role == 'employee'){
                $user = new User();
                $user->userName = $request->input("username");
                $user->role = $request->input("role");
                $user->email = $request->input("email");
                $user->password = bcrypt($request->input('password'));
                // $lastinsertedid=$user->id;
                $user->save();
                Auth::login($user);
                return redirect()->route('employee.registers');
             } else if($request->role == 'customer'){
                $user = new User();
                $user->userName = $request->input("username");
                $user->role = $request->input("role");
                $user->email = $request->input("email");
                $user->password = bcrypt($request->input('password'));
                // $lastinsertedid=$user->id;
                $user->save();
                Auth::login($user);
                return redirect()->route('customer.registers');
             } 
            
        else{
            return view('welcome');
            }

        // elseif($request->Role == 'NOT-APPROVED'){
        //         // your code
        //     }

    }

    public function getSignin(){
        return view('user.signin');
    }

     public function getadminProfile(){
            $admin = admins::where('user_id',Auth::id())->first();
            return view('admin.profile',compact('admin'));
        }

    public function getemployeeProfile(){
            $employee = employee::where('user_id',Auth::id())->first();
            return view('employees.profile',compact('employee'));
        }

    public function getcustomerProfile(){
            $customer = customer::where('user_id',Auth::id())->first();
            return view('customers.profile',compact('customer'));
        }

    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
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
