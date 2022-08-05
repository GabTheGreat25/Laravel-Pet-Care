<?php

namespace App\Http\Controllers;

use App\DataTables\AnimalDataTable;
use App\Models\Animal;
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
use App\Imports\animalImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\ExcelRule;
use View as GlobalView;
use Auth;

class AnimalController extends Controller
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
    
    public function getpet()
    {
        $customers = Customer::with('animals')->where('user_id', Auth::id())->get();
        // dd($customers);c
        return View::make('animals.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customer::pluck('firstName', 'id');
        return view('animals.create',['customers' => $customers]);
    }

    public function petcreate()
    {
        $customers = customer::pluck('firstName', 'id');
        return view('animals.create',['customers' => $customers]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $customer = Customer::find($request->customer_id);
        $animal = new animal();
        $animal->customer()->associate($customer); 
       
            $animal->petName = $request->input("petName");
            $animal->Age = $request->input("Age");
            $animal->Type = $request->input("Type");
            $animal->Breed = $request->input("Breed");
            $animal->Sex = $request->input("Sex");
            $animal->Color = $request->input("Color");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/animals';
            $animal->img_path = '/images/animals/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

        $animal->save();
        return Redirect::route("getAnimal")->with(
            "New Animal Added!"
        );
    }

    public function petstore(Request $request)
    {
        $request->validate([
            'img_path' => ['mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $customer = Customer::find($request->customer_id);
        $animal = new animal();
        $animal->customer()->associate($customer); 
       
            $animal->petName = $request->input("petName");
            $animal->Age = $request->input("Age");
            $animal->Type = $request->input("Type");
            $animal->Breed = $request->input("Breed");
            $animal->Sex = $request->input("Sex");
            $animal->Color = $request->input("Color");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/animals';
            $animal->img_path = '/images/animals/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

        $animal->save();
        return Redirect::route("animal.getpet")->with(
            "New Animal Added!"
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
        $animals = DB::table('animals')
        ->leftjoin('customers','animals.customer_id','customers.id')
        ->select('animals.id', 'animals.petName','animals.Age', 'animals.Type', 'animals.Breed', 'animals.Sex','animals.Color', 'animals.img_path', 'customers.id', 'customers.lastName', 'customers.firstName')
        ->where('animals.id', $id)
        ->get();
        return View::make('animals.show', compact('animals'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animal::with('customer')->where('id',$id)->first();
        $customers = Customer::pluck('firstName','id');
        return View::make('animals.edit',compact('animal', 'customers'));
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
        $customer = Customer::find($request->customer_id);
        $animals = Animal::find($id);
        $animals->customer()->associate($customer);
        $validator = Validator::make($request->all(), Animal::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/images/animals/', $request->file('img_path'), $request->file('img_path')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('img_path')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/animals/';
                $input['img_path'] = '/images/animals/' . $fileName;
                $animals->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("getAnimal")->with(
                    "Animal Updated!"
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
        //
        $animals= Animal::find($id);
        $animals->forceDelete();
        return Redirect::route("getAnimal")->with(
                    "Animal Deleted!"
                );
    }

    public function getAnimal(AnimalDataTable $dataTable)
    {
        $animals = Animal::with(['customer'])->get();
        return $dataTable->render('animals.animal');
    }

    public function import(Request $request){
        $request->validate([
           'animal_upload' => ['required', new ExcelRule($request->file('animal_upload'))],
       ]);
       Excel::import(new AnimalImport, request()->file('animal_upload'));
       return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }
}
