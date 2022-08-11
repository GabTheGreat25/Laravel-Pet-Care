<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    //
    public function index()
    {
        //
        // $comments = DB::table('services') 
        // ->leftJoin('comments','services.id','=','comments.service_id')
        // ->select('comments.id', 'services.servname', 'services.servname', 'services.description', 'services.price', 'services.img_path','comments.guestName','comments.gEmail', 'comments.cellnum', 'comments.gcomment', 'comments.created_at', 'comments.updated_at', 'comments.deleted_at','services.deleted_at')
        // ->get();
        // $comments = comments::withTrashed()->orderBy('comment_id','ASC')->paginate(5); 
        $services = Service::all()->whereNull('deleted_at');
        return View::make('comments.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create($id)
        
       //  $services = service::find($id);
        // $customers = Customer::find($id);
        // return view("customers.edit")->with("customers", $customers);
        
        $services = service::pluck('servname', 'id');
        return View::make('comments.create',['services' => $services]);

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
        // $request->validate([
        //     'service_id' =>'required|numeric', 
        //     'guestName'=>'required|regex:/^[a-zA-Z\s]*$/',
        //     'gEmail'=>'email| required',
        //     'cellnum'=>'required|numeric',
        //     'gcomment'=>'required|regex:/^[a-zA-Z\s]*$/'
        // ]);
        // $comment = new comments();
        // $comment->service_id = $request->input("service_id");
        // $comment->guestName = $request->input("guestName");
        // $comment->gEmail = $request->input("gEmail");
        // $comment->cellnum = $request->input("cellnum");
        // $comment->gcomment = $request->input("gcomment");

        // // $comment = service::find($id);
        // // $validator = Validator::make($request->all(), comments::$valRules);

        // $comment->save();
        // return Redirect::to('/transaction')->with('SUCCESS!','New comment added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function viewComment($id)
    {
        //
        $services = Service::find($id);
        $servicess = DB::table('services')
        ->rightJoin('comments','comments.service_id','services.id')
        ->select('comments.id', 'comments.created_at','comments.service_id','services.servname', 'comments.guestName', 'comments.gEmail', 'comments.cellnum','comments.gcomment','comments.deleted_at')
        ->where('services.id', $id)
        ->orderBy('comments.created_at','DESC')
        ->get();
   
        return View::make('comments.show',compact('services','servicess'));
    }

    // public function show($id)
    // {
    //     //

    //     $customers = DB::table('customers')
    //     ->leftJoin('animals','animals.customer_id','customers.id')
    //     ->select('customers.id', 'customers.title','customers.firstName', 'customers.lastName', 'customers.age', 'customers.address','customers.sex', 'customers.img_path', 'animals.petName','customers.phoneNumber')
    //     ->where('customers.id', $id)
    //     ->get();
   
    //     return view('customers.show', ['customers' => $customers]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function updateComment(Request $request,$id)
    {

            $request->validate([
            'guestName'=>'required',
            'gEmail'=>'email| required',
            'cellnum'=>'required|numeric',
            'gcomment'=>'required|profanity'
        ]);

            $comments = new comments;
            $comments->service_id = $id;
            $comments->guestName = $request->guestName;
            $comments->gEmail = $request->gEmail;
            $comments->cellnum = $request->cellnum;
            $comments->gcomment = $request->gcomment;
            $comments->save();
            return redirect()->back();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     comments::destroy($id);
    //     return Redirect::to('/comments')->with('SUCCESS!','comment deleted!');
    // }

    // public function restore($id)
    // {
    //     comments::onlyTrashed()->findOrFail($id)->restore(); 
    //     return  Redirect::route('comments.index')->with('SUCCESS','comment restored successfully!');
    // }

    // public function forceDelete($comment_id)
    // {

    //     comments::withTrashed()
    //     ->findOrFail($comment_id)
    //     ->forceDelete(); 
    //      return Redirect::route("comments.index")->with("SUCCESS!", "comment Permanently Deleted!");
    // }
}
