@extends('layouts.usermaster')
@section('title')
  Pet Search
@endsection
@section('content')
<h1>Search</h1>
{{-- {{dd($searchResults)}} --}}
There are {{ $searchResults->count() }} results.
@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   @foreach($modelSearchResults as $searchResult)
       <ul>
        {{-- {{dd($searchResult)}} --}}
            <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
             {{-- {{$searchResult->searchable->item->cost_price}} --}}
            </li>
       </ul>
   @endforeach
@endforeach
@endsection


