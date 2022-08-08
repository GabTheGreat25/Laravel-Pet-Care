<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\animal;
use App\Models\consultations;
use App\Models\diseases_injuries;

class petSearchController extends Controller
{
    //
    // public function search(Request $request){
    //     $searchResults = (new Search())
    //    ->registerModel(Item::class, 'description','cost_price','sell_price')
    //    ->registerModel(Customer::class, 'lname','fname','addressline','town')
    //    ->search($request->search);
    //    // dd($searchResults);
    //    // return view('item.search',compact('searchResults'));
    //    return view('search',compact('searchResults'));
    //    }

       public function petsearch(Request $request){
        $searchResults = (new Search())
       ->registerModel(Animal::class, 'petName')
       ->registerModel(consultations::class, 'dateConsult','fees','comment')
       ->registerModel(diseases_injuries::class, 'title')
       ->search($request->get('search'));
       // dd($searchResults);
       // return view('item.search',compact('searchResults'));
       return view('consultations.petsearch',compact('searchResults'));
       }
}
