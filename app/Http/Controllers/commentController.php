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
        ->select('comments.id', 'comments.created_at','comments.service_id','services.servname', 'comments.guestName', 'comments.gEmail', 'comments.cellnum','comments.gcomment','comments.deleted_at','services.img_path')
        ->where('services.id', $id)
        ->orderBy('comments.created_at','DESC')
        ->get();
   
        return View::make('comments.show',compact('services','servicess'));
    }

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
    public function destroy($id)
    {
        //
    }
}
