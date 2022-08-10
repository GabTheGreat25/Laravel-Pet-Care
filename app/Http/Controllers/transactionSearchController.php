<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\customer;
use App\Models\order;
use App\Models\service;


class transactionSearchController extends Controller
{
    //

    public function transactionsearch(Request $request){
        $searchResults = (new Search())
       ->registerModel(customer::class, 'firstName','lastName')
       ->registerModel(order::class, 'customer_id','schedule','status')
       ->registerModel(service::class, 'servname')
       ->search($request->get('search'));
       // dd($searchResults);
       // return view('item.search',compact('searchResults'));
       return view('transactions.customersearch',compact('searchResults'));
       }
}
