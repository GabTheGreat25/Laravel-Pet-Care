<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\consultations;
use App\Models\employee;
use App\Models\animal;
use App\Models\disease;
use App\Models\injury;
use App\Models\consultations_line;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consultations = DB::table('consultations')

        // ->leftJoin('employees','consultations.employee_id','=','employees.id')
        // ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
        // // ->leftJoin('animals','consultations_line.animal_id','=','animals.id')
        // ->leftJoin('diseases','consultations_line.disease_id','=','diseases.id')
        // ->leftJoin('injuries','consultations_line.injury_id','=','injuries.id')

        // ->leftJoin('consultations','consultations.id','=','consultations_line.consultations_line_id')

        // ->select('consultations.id', 'consultations.employee_id','consultations_line.animal_id','consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

        ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
        ->leftJoin('employees','employees.id','=','consultations.employee_id')
        ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
        ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
        ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')

        // ->select('listeners.id','listeners.listener_name','albums.album_name')
        // ->select('animals.id','animals.Name', 'animals.Age', 'animals.Type', 'animals.Breed', 'animals.Sex','animals.Color', 'animals.img_path', 'animals.customers_id','animals.created_at', 'animals.updated_at', 'animals.deleted_at', 'customers.customer_id', 'customers.firstName')
        ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

        ->get();

        return View::make('consultations.index', ['consultations' => $consultations]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees = employee::pluck('name', 'id');
        $animals = animal::pluck('petName', 'id');
        $diseases = disease::pluck('title', 'id');
        $injuries = injury::pluck('titles', 'id');
        return View::make('consultations.create',compact('employees', 'animals', 'diseases', 'injuries'));

        // $customers = customers::pluck('firstName', 'customer_id');
        // return View::make('animals.create',['customers' => $customers]);

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
        
        $success = false; //flag
        DB::beginTransaction();
        try {
            $consultations = new consultations;
            $consultations->employee_id = $request->input("employee_id");
            $consultations->dateConsult = $request->input("dateConsult");
            $consultations->fees = $request->input("fees");
            $consultations->comment = $request->input("comment");
            $consultations->save();

            $line = new consultations_line;
            $line->consultations_line_id = $consultations->id;
            $line->animal_id = $request->input("animal_id");
            $line->disease_id = $request->input("disease_id");
            $line->injury_id = $request->input("injury_id");
            

            // $consultations->username = $request::get('username');
            // $user->email = $request::get('email');
            $line->save();
    
            $success = true;
            if ($success) {
                DB::commit();
            }
    
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
            return ["error" => $e->getMessage()];
        }
    
        // return ["success" => "Data Inserted"];

         return redirect()->route('consultations.index')->with('SUCCESS!', 'Consultation added!');

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
        $consultations = consultations::all();
        return View::make('consultations.index',compact('consultations'));
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

        $consultations = consultations::find($id);
        $employees = employee::pluck('name', 'id');
        $animals = animal::pluck('petName', 'id');
        $diseases = disease::pluck('title', 'id');
        $injuries = injury::pluck('titles', 'id');

	    return View::make('consultations.edit',compact('consultations', 'employees', 'animals', 'diseases', 'injuries'));

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
        
        $success = false; //flag
        DB::beginTransaction();
        try {
            $request->validate([
                'id'=>'required|numeric',
                'dateConsult'=>'required',
                'fees'=>'required|numeric',
                'comment'=>'required|regex:/^[a-zA-Z\s]*$/',
    ]);

            $consultations = consultations::find($id);
            $consultations->employee_id = $request->input("id");
            $consultations->dateConsult = $request->input("dateConsult");
            $consultations->fees = $request->input("fees");
            $consultations->comment = $request->input("comment");

            $consultations->update();

            $success = true;
            if ($success) {
                DB::commit();
            }
    
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
            return ["error" => $e->getMessage()];
        }
    
        // return ["success" => "Data Inserted"];

         return redirect()->route('consultations.index')->with('SUCCESS!', 'consultation edited!');

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
        consultations::destroy($id);
        return Redirect::to('/consultations')->with('SUCCESS!','Record deleted!');
    }

    public function restore($id)
    {
        consultations::onlyTrashed()->findOrFail($id)->restore(); 
        return  Redirect::route('consultations.index')->with('SUCCESS','Consultation restored successfully!');
    }

    // public function forceDelete($consult_id)
    // {

    //     consultations::withTrashed()
    //     ->findOrFail($consult_id)
    //     ->forceDelete(); 
    //      return Redirect::route("consultations.index")->with("SUCCESS!", "Consultation Permanently Deleted!");

    // }

    public function search(Request $request){
        $search_text = $request->get('query');
        $consultations = DB::table('consultations')
  
        ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
        ->leftJoin('employees','employees.id','=','consultations.employee_id')
        ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
        ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
        ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')
        
        ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

        // ->select('animals.id', 'animals.img_path','animals.petName','employees.id', 'employees.name', 'diseases.id',  'diseases.title','injuries.id','injuries.titles', 'animals.img_path', 'consultations.id', 'consultations.employee_id','consultations.animal_id', 'consultations.dateConsult','consultations.fees','consultations.disease_id', 'consultations.injury_id', 'consultations.comment',)

        ->where('petName', 'LIKE', '%' .$search_text.'%') 
        ->get();

        return View::make('consultations.search',compact('consultations'));
      }
}
