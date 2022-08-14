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

        if (empty($request->get('search'))) {
            $consultations = consultations::with('animals')->get(); 
        
        }
    
        else {

            $consultations = consultations::whereHas('animals', function($q) use($request){
                $q->where("petName","LIKE", "%".$request->get('search')."%");})
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
              
        $animals = animal::with('consultations')->where('id',$id)->get();
        $consultations = consultations::with('diseases_injuries','employee')->where('animal_id',$id)->get();
        return view('consultations.show',compact('animals','consultations'));


        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $consultations = consultations::find($id);
            $consultations_diseases_injuries = DB::table('consultations_diseases_injuries')
                            ->where('consultations_id',$id)
                            ->pluck('diseases_injuries_id')
                            ->toArray();
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
        $consultations->diseases_injuries()->detach();
        $consultations->delete();
        return Redirect::to('consultations')->with('success','New listener deleted!');

    }

    
    public function getconsultation(ConsultationsDataTable $dataTable)
    {
        $diseases_injuries = diseases_injuries::get();
        $animals = animal::get();
        return $dataTable->render('consultations.consultation', compact('diseases_injuries','animals'));
        
    }
}


