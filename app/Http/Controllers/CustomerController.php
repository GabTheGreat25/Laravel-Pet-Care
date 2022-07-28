<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
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
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
       
    //     $input = $request->all();
    //     $request->validate([
    //     "title" => ["required", "min:2"],
    //     "firstName" => ["required", "min:3"],
    //     "lastName" => ["required", "min:3"],
    //     "age" => ["required", "numeric"],
    //     "address" => ["required", "min:3"],
    //     "sex" => ["required"],
    //     "phonenumber" => ["required", "numeric"],
    //     'image' => ['mimes:jpeg,png,jpg,gif,svg'],
    //     ]);

    //     if ($file = $request->hasFile('image')) {

    //         $file = $request->file('image');
    //         $fileName = $file->getClientOriginalName();
    //         $destinationPath = public_path() . '/images/customers';
    //         $input['img_path'] = '/images/customers/' . $fileName;
    //         $file->move($destinationPath, $fileName);
    //     }
    //     $customer = Customer::create($input);
    //     Event::dispatch(new SendMail($customer));
    //     return Redirect::route("getCustomer")->with(
    //         "New Customer Added!"
    //     );
    // }

    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
             'image' => ['mimes:jpeg,png,jpg,gif,svg' ]
        ]);

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/customers';
            $input['img_path'] = '/images/customers/' . $fileName;
           
            $file->move($destinationPath,$fileName); 
        }
        // $input['password'] = bcrypt($request->password);
        $customer = Customer::create($input);
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
    public function edit($id)
    {
        //
        $customers = Customer::find($id);
        return view("customers.edit")->with("customers", $customers);
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
        $customers = Customer::find($id);
        $validator = Validator::make($request->all(), Customer::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/images/customers/', $request->file('image'), $request->file('image')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('image')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('image')) {
                $file = $request->file('image');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers= Customer::find($id);
        $customers->animals()->delete();
        $customers->delete();
        $customers = Customer::with('animals')->get();
        return Redirect::route("getCustomer")->with(
                    "Customer Deleted!"
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
