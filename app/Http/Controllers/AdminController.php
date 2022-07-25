<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\admins;

class AdminController extends Controller
{
    public function __construct(){
        $this->total = 0;
    }
    
    public function getregister(){
        return view('admin.register');
    }

    public function postregistered(Request $request)
    {
        //
        $this->validate($request, [
            'name' =>'required|regex:/^[a-zA-Z\s]*$/', 
            'job'=>'required|regex:/^[a-zA-Z\s]*$/',
            'address'=>'required|regex:/^[a-zA-Z\s]*$/',
            'phonenumber'=>'required|numeric',
            'img_path' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG',

        ]);

        $user = new user();
        $admin = new admins();
            $admin->user_id = $user->id;
            $admin->name = $request->input("name");
            $admin->job = $request->input("job");
            $admin->address = $request->input("address");
            $admin->phonenumber = $request->input("phonenumber");

            if ($request->hasfile("img_path")) {
                $file = $request->file("img_path");
                $filename = $file->getClientOriginalName();
                $file->move('images/admin/', $filename);
                $admin->img_path = $filename;
            }
        
        $admin->save();
        Auth::login($admin);
        return redirect()->route('/');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
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
    public function show($id)
    {
        //
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
