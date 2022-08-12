<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\consultations;
use App\Models\employee;
use App\Models\animal;
use App\Models\diseases_injuries;
use App\Models\consultations_disease_injuries;
use App\DataTables\ConsultationsDataTable;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\Event;
use App\Events\SendConsultation;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        ///-----sa search na to 
        if (empty($request->get('search'))) {
            $consultations = consultations::with('animals')->get(); //dito ay di ko ata to ginamit e
        
        }
    
        else {

            $consultations = consultations::whereHas('animals', function($q) use($request){
                $q->where("petName","LIKE", "%".$request->get('search')."%");})
                //   ->orWhere("petName","LIKE", "%".$request->get('search')."%");
                //   })->orWhere('listener_name',"LIKE", "%".$request->get('search')."%")
              ->get();
          }
      
          $url = 'consultations';
      
        return View::make('Consultations.index',compact('consultations','url'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      

        $diseases_injuries = diseases_injuries::get();
        
        return View::make('consultations.consultation', compact('diseases_injuries'));

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

        $input = $request->all();
        $consultations = consultations::create($input);
        Event::dispatch(new SendConsultation($consultations)); 
        if(!(empty($request->diseases_injuries_id))){
                $consultations->diseases_injuries()->attach($request->diseases_injuries_id); 
          } 

        return Redirect::route('getconsultation')->with('success','Consultation created!');
        } 
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $consultations = DB::table('consultations')
        // ->leftJoin('consultations','consultations.id','=','consultations_disease_injuries.consultations_id')
        // ->leftJoin('employees','employees.id','=','consultations.employee_id')
        // ->leftJoin('animals','animals.id','=','consultations_disease_injuries.animals_id')
        // ->leftJoin('diseases_injuries','diseases_injuries.id','=','consultations_disease_injuries.disease_injuries_id')
        // ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_disease_injuries.animals_id', 'diseases_injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_disease_injuries.disease_injuries_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases_injuries.title')
        // ->where('consultations.animal_id', $id)
        // ->get();
        // return view('consultations.show',compact('consultations','animal','employee','diseases_injuries','consultations_diseases_injuries'));

            // $consultations = consultations::where('animal_id',$id)->get();
            // $animal = animal::pluck('petName','img_path','id');
            // $employee = Employee::pluck('name','id');
            // $diseases_injuries = diseases_injuries::pluck('title','id');
            // $consultations_diseases_injuries = DB::table('consultations_diseases_injuries')
            //                     ->where('consultations_id',$id)
            //                     ->pluck('diseases_injuries_id')
            //                     ->toArray();
            //id nino to?        
            $animals = animal::with('consultations')->where('id',$id)->get();
            $consultations = consultations::with('diseases_injuries','employee')->where('animal_id',$id)->get();
        //    dd($consultations);
         return view('consultations.show',compact('animals','consultations'));
            // $consultations = DB::table('consultations')
  
            // ->leftJoin('consultations_diseases_injuries','consultations.id','=','consultations_diseases_injuries.consultations_id')
            // ->leftJoin('employees','employees.id','=','consultations.employee_id')
            // ->leftJoin('animals','animals.id','=','consultations.animal_id')
            // ->leftJoin('diseases_injuries','diseases_injuries.id','=','consultations_diseases_injuries.diseases_injuries_id')
            
            // ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations.animal_id', 'diseases_injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_diseases_injuries.diseases_injuries_id',  'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases_injuries.title',)
    
            // // ->select('animals.id', 'animals.img_path','animals.petName','employees.id', 'employees.name', 'diseases.id',  'diseases.title','injuries.id','injuries.titles', 'animals.img_path', 'consultations.id', 'consultations.employee_id','consultations.animal_id', 'consultations.dateConsult','consultations.fees','consultations.disease_id', 'consultations.injury_id', 'consultations.comment',)
    
            // ->where('animal_id',$id) 
            // ->get();
            // return View::make('consultations.show',compact('consultations'));

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
            $consultations_diseases_injuries = DB::table('consultations_diseases_injuries')
                            ->where('consultations_id',$id)
                            ->pluck('diseases_injuries_id')
                            ->toArray();
        // $animals = animal::pluck('petName', 'id');
        $diseases_injuries = diseases_injuries::pluck('title', 'id');
    
        return View::make('consultations.edit', compact('diseases_injuries', 'consultations', 'consultations_diseases_injuries'));
    
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

        $consultations = consultations::find($id);
        $diseases_injuries_id = $request->input('diseases_injuries_id');
        $consultations->diseases_injuries()->sync($diseases_injuries_id);
        $consultations->update($request->all());

        return Redirect::route('getconsultation')->with('success', 'consultation updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultations = consultations::find($id);
      //  $consultations->animals()->detach();
        $consultations->diseases_injuries()->detach();
        // DB::table('album_listener')->where('listener_id',$id)->delete();
        
        $consultations->delete();
     //   return Redirect::route('listener')->with('success','listener deleted!');
        return Redirect::to('consultations')->with('success','New listener deleted!');

    }

    
    public function getconsultation(ConsultationsDataTable $dataTable)
    {
        $diseases_injuries = diseases_injuries::get();
        $animals = animal::get();
        return $dataTable->render('consultations.consultation', compact('diseases_injuries','animals'));
        
    }

    
    // public function restore($id)
    // {
    //     consultations::onlyTrashed()->findOrFail($id)->restore(); 
    //     return  Redirect::route('consultations.index')->with('SUCCESS','Consultation restored successfully!');
    // }

    // public function forceDelete($consult_id)
    // {

    //     consultations::withTrashed()
    //     ->findOrFail($consult_id)
    //     ->forceDelete(); 
    //      return Redirect::route("consultations.index")->with("SUCCESS!", "Consultation Permanently Deleted!");

    // }

    // public function search(Request $request){
    //     $search_text = $request->get('query');
    //     $consultations = DB::table('consultations')
  
    //     ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
    //     ->leftJoin('employees','employees.id','=','consultations.employee_id')
    //     ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
    //     ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
    //     ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')
        
    //     ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

    //     // ->select('animals.id', 'animals.img_path','animals.petName','employees.id', 'employees.name', 'diseases.id',  'diseases.title','injuries.id','injuries.titles', 'animals.img_path', 'consultations.id', 'consultations.employee_id','consultations.animal_id', 'consultations.dateConsult','consultations.fees','consultations.disease_id', 'consultations.injury_id', 'consultations.comment',)

    //     ->where('petName', 'LIKE', '%' .$search_text.'%') 
    //     ->get();

    //     return View::make('consultations.search',compact('consultations'));
    //   }


    // public function search(Request $request){
    //     $searchResults = (new Search())
    //    ->registerModel(Item::class, 'description','cost_price','sell_price')
    //    ->registerModel(Customer::class, 'lname','fname','addressline','town')
    //    ->search($request->search);
       
    //    return view('search',compact('searchResults'));
    //    }
   // a pet and show it's medical history. 
}


