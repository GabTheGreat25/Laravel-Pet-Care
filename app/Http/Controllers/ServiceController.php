<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $services = Service::withTrashed()->paginate(6);
        if (empty($request->get('search'))) {
            $services = Service::all();
        } else {
            $services = Service::all()
                ->where("servname", "LIKE", "%" . $request->get('search') . "%")
                ->get();
        }

        $url = 'services';
        return View::make('services.index', compact('services', 'url'));
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

    public function getService(Builder $builder)
    {
        $services = Service::query();
        if (request()->ajax()) {
            return DataTables::of($services)
                ->addColumn('action', function ($row) {
                    return "<a href=" . route('service.edit', $row->id) . " class=\"btn btn-warning\">Edit</a>
        <form action=" . route('service.destroy', $row->id) . " method= \"POST\" >" . csrf_field() .
                        '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
                })
                ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'servname', 'name' => 'servname', 'title' => 'Service Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'img_path', 'name' => 'img_path', 'title' => 'Service Image'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At', 'searchable' => false, 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'searchable' => false, 'orderable' => false, 'exportable' => false],

        ]);

        return view('services.service', compact('html'));
    }

}
