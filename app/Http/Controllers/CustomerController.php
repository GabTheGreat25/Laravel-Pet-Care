<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\ExcelRule;
use App\Events\SendMail;
use Event;

class CustomerController extends Controller
{

    public function __construct(){
        $this->total = 0;
    }
    
    public function getregister(){
        return view('customers.register');
    }

    public function postregistered(Request $request)
    {
        $user = new User();
        $user->userName = $request->input("firstName");
        $user->role = 'customer';
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $this->validate($request, [
            'title' =>'required|regex:/^[a-zA-Z\s]*$/', 
            'firstName'=>'required|regex:/^[a-zA-Z\s]*$/',
            'lastName'=>'required|regex:/^[a-zA-Z\s]*$/',
            'age'=>'required|numeric',
            'address'=>'required|regex:/^[a-zA-Z\s]*$/',
            'sex'=>'required|regex:/^[a-zA-Z\s]*$/',
            'phonenumber'=>'required|numeric',
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $customer = new customer();
      
            $customer->user_id = $user->id;
            $customer->title = $request->input("title");
            $customer->firstName = $request->input("firstName");
            $customer->lastName = $request->input("lastName");
            $customer->age = $request->input("age");
            $customer->address = $request->input("address");
            $customer->sex = $request->input("sex");
            $customer->phonenumber = $request->input("phonenumber");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/customers';
            $customer->img_path = '/images/customers/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

        $customer->save();
        Event::dispatch(new SendMail($customer));   
        Auth::login($user);
        return redirect()->route('customer.profile');
    }

    public function getcustomerProfile(){
        $customer = customer::where('user_id',Auth::id())->first();
        return view('customers.profile',compact('customer'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::leftJoin(
            "animals",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->select(
                "customers.id",
                "customers.title",
                "customers.firstName",
                "customers.lastName",
                "customers.age",
                "customers.address",
                "customers.sex",
                "customers.phonenumber",
                "customers.img_path",
                "customers.deleted_at",
            )
            ->orderBy("customers.id", "ASC")
            ->onlyTrashed()
            ->paginate(6);

            return view("customers.index", ["customers" => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) 
    {
        $user = new User([
            'userName' => $request->firstName,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->role,
        ]);
         $user->save();

        $this->validate($request, [
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $customer = new customer();
       
            $customer->user_id = User::latest()->pluck('id')->first();
            // dd(User::latest()->pluck('id')->first());
            $customer->title = $request->input("title");
            $customer->firstName = $request->input("firstName");
            $customer->lastName = $request->input("lastName");
            $customer->age = $request->input("age");
            $customer->address = $request->input("address");
            $customer->sex = $request->input("sex");
            $customer->phonenumber = $request->input("phonenumber");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/customers';
            $customer->img_path = '/images/customers/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

        $customer->save();
        Event::dispatch(new SendMail($customer));   
        return Redirect::route("getCustomer")->with(
            "New Customer Added!"
         );
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customers = DB::table('customers')
        ->select('customers.id', 'customers.user_id', 'customers.title', 'customers.firstName', 'customers.lastName', 'customers.age', 'customers.address', 'customers.sex', 'customers.phonenumber', 'customers.img_path')
        ->where('customers.id', $id)
        ->get();
    return View::make('customers.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //EDIT IN CRUD
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view("customers.edit")->with("customers", $customers);
    }
 
    //EDIT FOR CUSTOMER PROFILE
    public function profileedit($id)
    {
        $customers = Customer::where('user_id',Auth::id())->first();
        $user = user::with('customer')->where('id',$customers->id)->get();
        return view("customers.profileedit")->with("customers", $customers);
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
        $customers = Customer::find($id);
        $validator = Validator::make($request->all(), Customer::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/images/customers/', $request->file('img_path'), $request->file('img_path')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('img_path')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/customers';
                $input['img_path'] = 'images/customers/' . $fileName;
                $customers->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("getCustomer")->with(
                    "Customer Updated!"
                );
            }
        }
    }

    public function profileupdate(Request $request, $id)
    {
        $customers = Customer::find($id);
        $validator = Validator::make($request->all(), Customer::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

       if ($validator->passes()) {
            $path = Storage::putFileAs('/images/customers/', $request->file('img_path'), $request->file('img_path')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('img_path')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/customers';
                $input['img_path'] = 'images/customers/' . $fileName;
                $customers->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("customer.profile")->with(
                    "Profile Updated!"
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::with('user')->find($id);
        $customer = Customer::with('animals')->find($id);
        $customer->user()->delete();
        $customer->animals()->delete();

        $customers = Customer::destroy($id);
        $customer->delete();

        return Redirect::route("getCustomer")->with(
                    "Customer Deleted!"
                );
    }

    public function restore($id)
    {
      $customers = Customer::onlyTrashed()->find($id);
      $customers->restore();

      $customerss = Customer::with('animals')->find($id);
      $customerss->animals()->restore();

      $customer =  Customer::with('user')->find($id);
      $customer->user()->restore();

        return Redirect::route("getCustomer")->with(
            "Customer Restored!"
        );
    }

    public function getCustomer(CustomerDataTable $dataTable)
    {
        $customers = Customer::with([])->get();
        return $dataTable->render('customers.customer');
    }

    public function import(Request $request){
        $request->validate([
           'customer_upload' => ['required', new ExcelRule($request->file('customer_upload'))],
       ]);
       Excel::import(new CustomerImport, request()->file('customer_upload'));
       return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }

}
