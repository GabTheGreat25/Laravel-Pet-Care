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

        // $consultations = DB::table('consultations')
        // ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
        // ->leftJoin('employees','employees.id','=','consultations.employee_id')
        // ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
        // ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
        // ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')
        // ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

        // ->get();

        // return View::make('consultations.index', ['consultations' => $consultations]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $employees = employee::pluck('name', 'id');
        // $animals = animal::pluck('petName', 'id');
        // $diseases_injuries = diseases_injuries::pluck('title', 'id');
        // // return View::make('consultations.create',compact('employees', 'animals', 'diseases', 'injuries'));

        // return view('consultations.create',['employees' => $employees, 'animals' => $animals, 'diseases_injuries' => $diseases_injuries]);
        // // $customers = customers::pluck('firstName', 'customer_id');
        // // return View::make('animals.create',['customers' => $customers]);

        $diseases_injuries = diseases_injuries::with('animals')->get();
        
        return View::make('consultations.create', compact('diseases_injuries'));

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
        // $consultations = consultations::create($input);
        // // Event::dispatch(new SendMail($listener));
        // if(!(empty($request->disease_injuries_id))){
        //         $consultations->diseases_injuries()->attach($request->disease_injuries_id);
        //   }
        // return Redirect::route('getconsultation')->with('success','listener created!');

        // $this->validate($request, [
        //     'employee_id' => 'required| numeric',
        //     'fees' => 'required| numeric',
        //     'comment' => 'required| min:4'
        // ]);

        $consultations = new consultations([
              'employee_id' => $request->input('employee_id'),
              'dateConsult' => $request->input('dateConsult'),
              'fees' => $request->input('fees'),
              'comment' => $request->input('comment'),
          ]);
           $consultations->save();

            $line = new consultations_disease_injuries;
            $line->consultations_id = $consultations->id;
            $line->animals_id = $request->input("animals_id");
            $line->disease_injuries_id = $request->input("disease_injuries_id");
            $line->save();
    
         return redirect()->route('getconsultation')->with('SUCCESS!', 'Consultation added!');

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
        // $consultations = consultations::all();
        // return View::make('consultations.index',compact('consultations'));

    //     $consultations = DB::table('consultations')
    //     ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
    //     ->leftJoin('employees','employees.id','=','consultations.employee_id')
    //     ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
    //     ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
    //     ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')
    //     ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

    //     ->get();

    //     //return View::make('consultations.show', ('consultations'));
    //    // return View::make('consultations.show', ['consultations' => $consultations]);
    //     return View::make('consultations.show', ('consultations'));


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

        $consultation_disease_injuries = array();
        $consultations = consultations::with('diseases_injuries')->where('id', $id)->first();
        if (!(empty($consultations->diseases_injuries))) {
            foreach ($consultations->diseases_injuries as $consultation_disease_injuries) {
                $consultation_disease_injuries[$consultation_disease_injuries->id] = $consultation_disease_injuries->title;
            }
        }
        
        $diseases_injuries = diseases_injuries::pluck('title', 'id')->toArray();

        return View::make('consultations.edit', compact('diseases_injuries', 'consultations', 'consultation_disease_injuries' ,'animals'));

//-------
        //  $listener_albums = array();
        // $listener = Listener::with('albums')->where('id', $id)->first();
        // if (!(empty($listener->albums))) {
        //     foreach ($listener->albums as $listener_album) {
        //         $listener_albums[$listener_album->id] = $listener_album->album_name;
        //     }
        // }
        // $albums = Album::pluck('album_name', 'id')->toArray();

        // return View::make('listener.edit', compact('albums', 'listener', 'listener_albums'));
//--------------
        // $consultations = consultations::find($id);
        // $employees = employee::pluck('name', 'id');
        // $animals = animal::pluck('petName', 'id');
        // $diseases_injuries = diseases_injuries::pluck('title', 'id');

	    // return View::make('consultations.edit',compact('consultations', 'employees', 'animals', 'diseases', 'injuries'));

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
        $diseases_injuriess = $request->input('animals_id');
        $diseases_injuriess = $request->input('diseases_injuries_id');
      
        $consultations->diseases_injuries()->sync($diseases_injuriess);

        $consultations->update($request->all());

        return Redirect::route('consultations.index')->with('success', 'consultations updated!');


    //         $request->validate([
    //             'id'=>'required|numeric',
    //             'dateConsult'=>'required',
    //             'fees'=>'required|numeric',
    //             'comment'=>'required|regex:/^[a-zA-Z\s]*$/',
    // ]);

    //         $consultations = consultations::find($id);
    //         $consultations->employee_id = $request->input("id");
    //         $consultations->dateConsult = $request->input("dateConsult");
    //         $consultations->fees = $request->input("fees");
    //         $consultations->comment = $request->input("comment");

    //         $consultations->update();

    //      return redirect()->route('getconsultation')->with('SUCCESS!', 'consultation edited!');

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
        // DB::table('album_listener')->where('listener_id',$id)->delete();
        
        $consultations->delete();
     //   return Redirect::route('listener')->with('success','listener deleted!');
        return Redirect::to('consultations')->with('success','New listener deleted!');

        //-----
        // consultations::destroy($id);
        // return Redirect::to('/consultations')->with('SUCCESS!','Record deleted!');
   //------
        // $consultations= consultations::find($id);
        // $consultations->delete();
        // return Redirect::route("getconsultation")->with(
        //             "Animal Deleted!"
        //         );
    }

    
    public function getconsultation(ConsultationsDataTable $dataTable)
    {
        $diseases_injuries = diseases_injuries::with('animals')->get();
        return $dataTable->render('consultations.consultation', compact('diseases_injuries'));
        
        // $consultations = consultations::with(['employee','animal','disease','injury'])->get();
        //return $dataTable->render('consultations.consultation',compact('consultations'));
 // $consultations = consultations::with('animal','disease','injury')->get();
        // return $dataTable->render('animals.animal', compact('consultations'));

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
}
