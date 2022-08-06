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

        // $consultations = DB::table('consultations')
        // ->leftJoin('consultations_line','consultations.id','=','consultations_line.consultations_line_id')
        // ->leftJoin('employees','employees.id','=','consultations.employee_id')
        // ->leftJoin('animals','animals.id','=','consultations_line.animal_id')
        // ->leftJoin('diseases','diseases.id','=','consultations_line.disease_id')
        // ->leftJoin('injuries','injuries.id','=','consultations_line.injury_id')
        // ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_line.animal_id', 'diseases.id', 'injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_line.disease_id', 'consultations_line.injury_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases.title', 'injuries.titles')

        // ->get();

        // return View::make('consultations.index', ['consultations' => $consultations]);


        ///-----sa search na to
        if (empty($request->get('search'))) {
            $consultations = consultations::with('animals')->get();
        
        }
    
        else {

            $consultations = consultations::whereHas('animals', function($q) use($request){
                $q->where("petName","LIKE", "%".$request->get('search')."%");})
                //   ->orWhere("petName","LIKE", "%".$request->get('search')."%");
                //   })->orWhere('listener_name',"LIKE", "%".$request->get('search')."%")
              ->get();
          }
      
          $url = 'consultations';
      
        // return View::make('consultations.consultation',compact('consultations','url'));
        // return Redirect::route('getconsultation')->with('success','listener created!');
        return View::make('consultations.index',compact('consultations','url'));

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

//         $input = $request->all();
//         $consultations = consultations::create($input);
//         Event::dispatch(new SendMail($consultations));
// //eto email pagkaconsul oto oo tsaka na yan unahin muna prob nw umay sapakin ko vs mo pwede ba try mo sayo kung nagana bago mo sapaken HASHSAH boset ka HAHAHHAHAHA baka cdoe talaga mali
//         if(!(empty($request->disease_injuries_id))){
//                 $consultations->diseases_injuries()->attach($request->disease_injuries_id);
//             }

//         // if(!(empty($request->animals_id))){
//         //     $consultations->animals()->attach($request->animals_id);      
//         // }
   
//         return Redirect::route('getconsultation')->with('success','consultations created!');

        // $this->validate($request, [
        //     'employee_id' => 'required| numeric',
        //     'fees' => 'required| numeric',
        //     'comment' => 'required| min:4'
        // ]);

     //   $try = DB::table('consultations')->rightJoin('animals', 'consultations.animal_id', '=', 'animals.id')->leftJoin('customers', 'customers.id', '=', 'animals.customer_id')->leftJoin('users', 'users.id', '=', 'customers.user_id')->select('customers.*, users.*')->get();

        //------nagana
        // $consultations = new consultations([
        //       'employee_id' => $request->input('employee_id'),
        //       'animal_id' => $request->input('animal_id'),
        //       'dateConsult' => $request->input('dateConsult'),
        //       'fees' => $request->input('fees'),
        //       'comment' => $request->input('comment'),
        //   ]);
        //    $consultations->save();

        //    $line = new consultations_disease_injuries;
        //     $line->consultations_id = $consultations->id;
        //     // $input = $request->all();
        //     // $input['diseases_injuries_id'] = $request->input('diseases_injuries_id');
        //     // $line = consultations_disease_injuries::create($input);

        //     // $line = consultations_disease_injuries::create($input);
        // // if(!(empty($request->diseases_injuries_id))){
        //     //$line->consultations_id = $consultations->id;
        //     $line->diseases_injuries_id = $request->input("disease_injuries_id");
        // //  $line->diseases_injuries()->attach($request->diseases_injuries_id);
        // Event::dispatch(new SendConsultation($try));
        //  $line->save();
        // return redirect()->route('getconsultation')->with('SUCCESS!', 'Consultation added!');

        $input = $request->all();
     //   $input['password'] = bcrypt($request->password);
        $consultations = consultations::create($input);
       // Event::dispatch(new SendConsultation($consultations));
        if(!(empty($request->diseases_injuries_id))){
                $consultations->diseases_injuries()->attach($request->diseases_injuries_id);
          } //need ata toh? ay yan error kanina e di pumapasok sa pivot pero yung sa consultations ok ngayon ayaw pag checkbox baka kasi di checkbox kanina? checkbox yunn? e
        return Redirect::route('getconsultation')->with('success','Consultation created!');
        } 
    
    

        // $input = $request->all();
        // $input['category'] = $request->input('category');
        // Post::create($input);



            // $line->diseases_injuries_id = $request->input("disease_injuries_id");
        
    
        //  return redirect()->route('getconsultation')->with('SUCCESS!', 'Consultation added!');

        //  $input = $request->all(); // baka need naka ge to HAHAHHA
        // $input['password'] = bcrypt($request->password);
        // $listener = Listener::create($input);

        // if(!(empty($request->album_id))){
        //         $listener->albums()->attach($request->album_id);
        //   }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $consultations = DB::table('consultations')
        // ->leftJoin('consultations_line','consultations.id','=','consultations_disease_injuries.consultations_id')
        // ->leftJoin('employees','employees.id','=','consultations.employee_id')
        // ->leftJoin('animals','animals.id','=','consultations_disease_injuries.animals_id')
        // ->leftJoin('diseases_injuries','diseases_injuries.id','=','consultations_disease_injuries.disease_injuries_id')
        // ->select('consultations.id', 'animals.id', 'animals.img_path', 'consultations.employee_id', 'employees.id', 'consultations_disease_injuries.animals_id', 'diseases_injuries.id', 'consultations.dateConsult', 'consultations.fees', 'consultations_disease_injuries.disease_injuries_id', 'consultations.comment', 'consultations.created_at', 'consultations.updated_at', 'consultations.deleted_at', 'employees.name', 'animals.petName', 'diseases_injuries.title')
        // ->where('consultations.id', $id)
        // ->get();
        // return View::make('consultations.show', compact('consultations'));
        
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

        // $listener_albums = array();
        // $listener = Listener::with('albums')->where('id', $id)->first();
        // if (!(empty($listener->albums))) {
        //     foreach ($listener->albums as $listener_album) {
        //         $listener_albums[$listener_album->id] = $listener_album->album_name;
        //     }
        // }


    //     $diseases_injuries = diseases_injuries::get();
    //     $consultations_diseases_injuries = array();
    //   //  $consultations = consultations::with('animals')->where('id', $id)->first();
    //     $consultations = consultations::with('diseases_injuries')->where('id', $id)->first();
    
    //     if (!(empty($consultations->diseases_injuries))) {
    //         foreach ($consultations->diseases_injuries as $consultations_diseases_injuries) {
    //             $consultations_diseases_injuries[$consultations_diseases_injuries->id] = $consultations_diseases_injuries->title;
    //         }
    //     }

        // if (!(empty($consultations->animals))) {
        //         foreach ($consultations->animals as $consultations_diseases_injuries) {
        //             $consultations_diseases_injuries[$consultations_diseases_injuries->id] = $consultations_diseases_injuries->petName;
        //         }
        // }
    
         $consultations = consultations::find($id);
            $consultations_diseases_injuries = DB::table('consultations_diseases_injuries')
                            ->where('consultations_id',$id)
                            ->pluck('diseases_injuries_id')
                            ->toArray();
        // $animals = animal::pluck('petName', 'id');
        $diseases_injuries = diseases_injuries::pluck('title', 'id');
    
        return View::make('consultations.edit', compact('diseases_injuries', 'consultations', 'consultations_diseases_injuries'));
    
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
        
        // $consultations = consultations::find($request->id);
        // $diseases_injuries = diseases_injuries::find($id);
        // $diseases_injuries->consultations()->associate($consultations);

        // return Redirect::route("getconsultation")->with(
        //     "Consultation Updated!"
        // );

        // $listener = Listener::find($id);
        // $album_ids = $request->input('album_id');
        // $listener->albums()->sync($album_ids);
        // $listener->update($request->all());
        // return Redirect::route('listener.index')->with('success', 'lister updated!');

        // $consultations = consultations::find($id);
        // // $animals_id = $request->input('animals_id');
        // $diseases_injuries_id = $request->input('diseases_injuries_id');
        // // $consultations->animals()->sync($animals_id);
        // $consultations->diseases_injuries()->sync($diseases_injuries_id);
        // $consultations->update($request->all());
        // return Redirect::route('getconsultation')->with('success', 'consultations updated!');



        $consultations = consultations::find($id);
        $diseases_injuries_id = $request->input('diseases_injuries_id');
        $consultations->diseases_injuries()->sync($diseases_injuries_id);
        $consultations->update($request->all());

        return Redirect::route('getconsultation')->with('success', 'consultation updated!');

//---nagana
//         $consultations = consultations::find($id);

// $consultations->employee_id = $request->input("id");
// $consultations->dateConsult = $request->input("dateConsult");
// $consultations->fees = $request->input("fees");
// $consultations->comment = $request->input("comment");
// $consultations->animal_id = $request->input("animal_id");

//         $consultations_ids = $request->input('consultations_id');
//         // $diseases_injuriess = $request->input('diseases_injuries_id');
//         $consultations->diseases_injuries()->sync($consultations_ids);
//         $consultations->update($request->all());

//         $line = new consultations_disease_injuries;
//         $line->consultations_id = $consultations->id;
      
//         $line->diseases_injuries_id = $request->input("disease_injuries_id");
//         $line->save();

//         return Redirect::route('getconsultation')->with('success', 'consultations updated!');

///----

// $consultations = consultations::find($id);
// $consultations->employee_id = $request->input("id");
// $consultations->dateConsult = $request->input("dateConsult");
// $consultations->fees = $request->input("fees");
// $consultations->comment = $request->input("comment");

// $consultations->update();

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


    // $consultations = consultations::find($id);
    // $consultations = new consultations([
    //     'employee_id' => $request->input('employee_id'),
    //     'dateConsult' => $request->input('dateConsult'),
    //     'fees' => $request->input('fees'),
    //     'comment' => $request->input('comment'),
    // ]);
    //  $consultations->update();

    //  $diseases_injuries = diseases_injuries::find($id);
    //   $diseases_injuries = new consultations_disease_injuries;
    //   $diseases_injuries->animals_id = $request->input("animal_id");
    //   $diseases_injuries->diseases_injuries_id = $request->input("disease_injuries_id");
    //   $diseases_injuries->update();

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



    //    public function petsearch(Request $request){
    //     $petsearchResults = (new Search())
    //     ->registerModel(animal::class, 'petName','Age','Type','Breed','Sex','Color','customer_id')
    //    ->registerModel(consultations::class, 'employee_id','dateConsult','fees','comment')
    //    ->registerModel(consultations_disease_injuries::class, 'animals_id','disease_injuries_id')
    //    ->registerModel(diseases_injuries::class, 'title','description')
    //    ->search($request->search);
    //    // dd($searchResults);
    //    // return view('item.search',compact('searchResults'));
    //    return view('consultations.petsearch',compact('petsearchResults'));
    //    }
}


