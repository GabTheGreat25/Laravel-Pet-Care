<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\ServiceImport;
use Excel;
use App\Rules\ExcelRule;

class ServiceController extends Controller
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
        return view("services.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        $images=array();
         if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $destinationPath = public_path().'/images/services' ;
                $file->move($destinationPath,$name);
                $images[]='images/services/'.$name;
            }
        }

       $services = new Service([
            'img_path'=>  implode("|",$images),
            'servname' =>$input['servname'],
            'description' =>$input['description'],
            'price' =>$input['price'],
        ]);
        $services->save();
        return Redirect::route("getService")->with(
            "New Service Added!"
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
        $services = DB::table('services')
            ->select('services.id', 'services.servname', 'services.description', 'services.price', 'services.img_path')
            ->where('services.id', $id)
            ->get();
        return View::make('services.show', compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::find($id);
        return view("services.edit")->with("services", $services);
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
        $services = Service::find($id);
        $input = $request->all();
                        $images=array();
                        if($files=$request->file('images')){
                            foreach($files as $file){
                            $name=$file->getClientOriginalName();
                            $destinationPath = public_path().'/images/services' ;
                            $file->move($destinationPath,$name);
                            $images[]='images/services/'.$name;
                            } 
                        }
                        $input['img_path'] = implode("|",$images);
                        $services->update($input);
                             return Redirect::route("getService")->with(
                    "Service Updated!"
                );
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $services= Service::find($id);
        $services->delete();
        return Redirect::route("getService")->with(
                    "Service Deleted!"
                );
    }

    public function getService(ServiceDataTable $dataTable)
    {
        $services = Service::with([])->get();
        return $dataTable->render('services.service');
    }

    public function import(Request $request){
         $request->validate([
            'service_upload' => ['required', new ExcelRule($request->file('service_upload'))],
        ]);
        Excel::import(new ServiceImport, request()->file('service_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

}