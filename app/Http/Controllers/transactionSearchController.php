<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\customer;
use App\Models\order;
use App\Models\service;


class transactionSearchController extends Controller
{
    public function transactionsearch(Request $request){
        $searchResults = (new Search())
       ->registerModel(customer::class, 'firstName')
       ->search($request->get('search'));
       return view('transactions.customersearch',compact('searchResults'));
       }
}
