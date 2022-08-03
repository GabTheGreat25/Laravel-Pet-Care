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
        // if (empty($request->get('search'))) {
        //     $services = Service::all();
        // } else {
        //     $services = Service::all()
        //         ->where("servname", "LIKE", "%" . $request->get('search') . "%")
        //         ->get();
        // }

        // $url = 'services';
        // return View::make('services.index', compact('services', 'url'));
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
        $this->validate($request, [
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $services = new Service();
       
            $services->servname = $request->input("servname");
            $services->description = $request->input("description");
            $services->price = $request->input("price");

        if ($file = $request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $filename =  $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/services';
            $services->img_path = '/images/services/' . $filename;   
            $file->move($destinationPath,$filename); 
        }

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
        $validator = Validator::make($request->all(), Service::$valRules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('/images/services/', $request->file('img_path'), $request->file('img_path')->getClientOriginalName());

            $request->merge(["img_path" => $request->file('img_path')->getClientOriginalName()]);

            $input = $request->all();

            if ($file = $request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/images/services';
                $input['img_path'] = 'images/services/' . $fileName;
                $services->update($input);
                $file->move($destinationPath, $fileName);
                return Redirect::route("getService")->with(
                    "Service Updated!"
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