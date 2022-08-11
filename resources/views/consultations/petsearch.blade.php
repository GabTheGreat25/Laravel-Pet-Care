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

            {{-- <h1>{{ $searchResult->title }}</a> --}}
              <li><a href="{{ $searchResult->url('') }}">{{ $searchResult->title }}</a>
             {{-- {{$searchResult->searchable->item->cost_price}} --}}
            </h1>
       </ul>
   @endforeach
@endforeach
@endsection


