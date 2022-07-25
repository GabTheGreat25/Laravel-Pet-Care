<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::withTrashed()->paginate(6);
        return view("services.index", ["services" => $services]);
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
    public function store(serviceRequest $request)
    {
        $services = new Service();
        $services->servname = $request->input("servname");
        $services->description = $request->input("description");
        $services->price = $request->input("price");
        if ($request->hasfile("img_path")) {
            $file = $request->file("img_path");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/services/", $filename);
            $services->img_path = $filename;
        }
        $services->save();
        return Redirect::to("/service")->with(
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
    public function update(serviceRequest $request, $id)
    {
        $services = Service::find($id);
        $services->servname = $request->input("servname");
        $services->description = $request->input("description");
        $services->price = $request->input("price");
        if ($request->hasfile("img_path")) {
            $destination = "uploads/services/" . $services->img_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("img_path");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/services/", $filename);
            $services->img_path = $filename;
        }
        $services->update();
        return Redirect::to("/service")->with(
            "Service Data Updated!"
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
        Service::destroy($id);
        return Redirect::to("/service")->with(
            "Service Data Deleted!"
        );
    }

    public function restore($id)
    {
        Service::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("service.index")->with(
            "Service Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $Services = Service::findOrFail($id);
        $destination = "uploads/Services/" . $Services->img_path;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Services->forceDelete();
        return Redirect::route("service.index")->with(
            "Service Data Permanently Deleted!"
        );
    }
}
