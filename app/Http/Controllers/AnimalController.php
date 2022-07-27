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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        // $input = $request->all();
        // $request->validate([
        //     "petName" => ["required", "min:3"],
        //     "Age" => ["required", "numeric"],
        //     "Type" => ["required"],
        //     "Breed" => ["required"],
        //     "Sex" => ["required"],
        //     "Color" => ["required"],
        // ]);
        // if ($file = $request->hasFile('image')) {

        //     $file = $request->file('image');
        //     $fileName = $file->getClientOriginalName();
        //     $destinationPath = public_path() . '/images/animals';
        //     $input['img_path'] = '/images/animals/' . $fileName;
        //     $file->move($destinationPath, $fileName);
        // }
      
        // Animal::create($input);

        $request->validate([
            "petName" => ["required", "min:3"],
            "Age" => ["required", "numeric"],
            "Type" => ["required"],
            "Breed" => ["required"],
            "Sex" => ["required"],
            "Color" => ["required"],
]);

        $animal = new animal();
        $animal->petName = $request->input("petName");
        $animal->Age = $request->input("Age");
        $animal->Type = $request->input("Type");
        $animal->Breed = $request->input("Breed");
        $animal->Sex = $request->input("Sex");
        $animal->Color = $request->input("Color");
      
        if ($request->hasfile("img_path")) {
            $file = $request->file("img_path");
                $file = $request->file("img_path");
                $filename = $file->getClientOriginalName();
                $file->move('images/animals/', $filename);
                $animal->img_path = $filename;

        }

        $animal->customer_id = $request->input("id");

        $animal->save();
        return Redirect::route("getAnimal")->with(
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
        //
        // $animals = Animal::find($id);
        // $customers = Customer::pluck('firstName', 'id');
        // return View::make('animals.edit',compact('animals', 'customers'));

        $animals = Animal::find($id);
        return view("animals.edit")->with("animals", $animals);
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
        $animals = Animal::find($id);
        $validator = Validator::make($request->all(), Animal::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/images/animals/', $request->file('image'), $request->file('image')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('image')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/animals/';
                $input['img_path'] = '/images/animals/' . $fileName;
                $animals->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("getanimal")->with(
                    "animal Updated!"
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
        $animals->delete();
        return Redirect::route("getAnimal")->with(
                    "Animal Deleted!"
                );
    }

    public function getAnimal(AnimalDataTable $dataTable)
    {
        $animals = Animal::with([])->get();
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
