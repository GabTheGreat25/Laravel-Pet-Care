<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\animal;
use App\Models\consultations;
use App\Models\diseases_injuries;

class petSearchController extends Controller
{
       public function petsearch(Request $request){
        $searchResults = (new Search())
       ->registerModel(Animal::class, 'petName')
       ->search($request->get('search'));
       return view('consultations.petsearch',compact('searchResults'));
       }
}
