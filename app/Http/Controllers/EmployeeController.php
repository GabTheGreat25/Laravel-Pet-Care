<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Models\Employee;
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
use Excel;
use App\Rules\ExcelRule;

class EmployeeController extends Controller
{
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
        $input = $request->all();
        $request->validate([
        "name" => ["required", "min:3"],
        "position" => ["required"],
        "address" => ["required", "min:3"],
        "phonenumber" => ["required", "numeric"],
        'image' => ['mimes:jpeg,png,jpg,gif,svg'],
        ]);
        if ($file = $request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/folder/images';
            $input['img_path'] = '/folder/images/' . $fileName;
            $file->move($destinationPath, $fileName);
        }
        Employee::create($input);
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
        $validator = Validator::make($request->all(), Employee::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/folder/images/', $request->file('image'), $request->file('image')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('image')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/folder/images';
                $input['img_path'] = 'folder/images/' . $fileName;
                $employees->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("getEmployee")->with(
                    "Employee Updated!"
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
        $employees= Employee::find($id);
        $employees->delete();
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
