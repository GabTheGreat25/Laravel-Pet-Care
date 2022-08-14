<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\ExcelRule;
use Illuminate\Support\Facades\Auth; 

class EmployeeController extends Controller
{

    public function __construct(){
        $this->total = 0;
    }
    
    public function getregister(){
        return view('employees.register');
    }

    public function postregistered(Request $request)
    {
          $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);

        $user = new User();
                $user->userName = $request->input("name");
                $user->role = 'employee';
                $user->email = $request->input("email");
                $user->password = bcrypt($request->input('password'));

                $user->save();

        $this->validate($request, [
            'name' =>'required|regex:/^[a-zA-Z\s]*$/', 
            'position'=>'required|regex:/^[a-zA-Z\s]*$/',
            'address'=>'required|regex:/^[a-zA-Z\s]*$/',
            'phonenumber'=>'required|numeric',
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $employee = new employee();
      
            $employee->user_id = $user->id;
            // dd(User::latest()->pluck('id')->first());
            $employee->name = $request->input("name");
            $employee->position = $request->input("position");
            $employee->address = $request->input("address");
            $employee->phonenumber = $request->input("phonenumber");

            if ($file = $request->hasfile("img_path")) {
                $file = $request->file("img_path");
                $filename =  $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/employees';
                $employee->img_path = '/images/employees/' . $filename;   
                $file->move($destinationPath,$filename); 
            }

        $employee->save();
        Auth::login($user);
        return redirect()->route('employee.profile');
    }

    public function getemployeeProfile(){
        $employee = employee::where('user_id',Auth::id())->first();
        return view('employees.profile',compact('employee'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return view("employees.create");
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
            'userName' => $request->name,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->role,
        ]);
         $user->save();

        $this->validate($request, [
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $employee = new Employee();
       
            $employee->user_id = User::latest()->pluck('id')->first();
            // dd(User::latest()->pluck('id')->first());
            $employee->name = $request->input("name");
            $employee->position = $request->input("position");
            $employee->address = $request->input("address");
            $employee->phonenumber = $request->input("phonenumber");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/employees';
            $employee->img_path = '/images/employees/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

        $employee->save();
        return Redirect::route("getEmployee")->with(
            "New Employee Added!"
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
        $employees = DB::table('employees')
            ->select('employees.id', 'employees.user_id','employees.name', 'employees.position', 'employees.address', 'employees.phonenumber', 'employees.img_path')
            ->where('employees.id', $id)
            ->get();
        return View::make('employees.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::find($id);
        return view("employees.edit")->with("employees", $employees);
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
        $employees = Employee::find($id);
        $employees->position = $request->input('position');
        $employees->update();

        return Redirect::route("getEmployee")->with(
                    "Employee Updated!"
                );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees= Employee::find($id);
        $employees->user()->delete();
        $employees->delete();
        $employees = Employee::with('user')->get();
        return Redirect::route("getEmployee")->with(
                    "Employee Deleted!"
                );
    }

    public function getEmployee(EmployeeDataTable $dataTable)
    {
        $employees = Employee::with([])->get();
        return $dataTable->render('employees.employee');
    }

    public function import(Request $request){
         $request->validate([
            'employee_upload' => ['required', new ExcelRule($request->file('employee_upload'))],
        ]);
        Excel::import(new EmployeeImport, request()->file('employee_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}
