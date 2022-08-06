@extends('layouts.usermaster')
@section('title')
  Pet Consultation History
@endsection
@section('content')
<h1>Medical History</h1>

There are {{ $petsearchResults->count() }} results.
@foreach($petsearchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   @foreach($modelSearchResults as $petsearchResults)
       <ul>
        {{-- {{dd($searchResult)}} --}}
            <li><a href="{{ $petsearchResults->url }}">{{ $petsearchResults->title }}</a>
             {{-- {{$searchResult->searchable->item->cost_price}} --}}
            </li>
       </ul>
   @endforeach
@endforeach
@endsection