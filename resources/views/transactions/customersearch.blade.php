@extends('layouts.usermaster')
@section('title')
  Customer Search
@endsection
@section('content')
<style>
  .container{
     background-color: rgba(173, 128, 79, 0.753);
     width: 75rem;
     height: fit-content;
     padding: 1rem 3rem;
     border-radius: .75rem; 

 }
 </style>

<div class="container">
<h1>𝐒𝐞𝐚𝐫𝐜𝐡</h1>
{{-- {{dd($searchResults)}} --}}
There are {{ $searchResults->count() }} results.
<h2>≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡</h2>
@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   @foreach($modelSearchResults as $searchResult)
       <ul>
        {{-- {{dd($searchResult)}} --}}
        <h3 style="background-color: rgba(255, 255, 255, 0.87)"><li><a style="color: rgb(103, 8, 8)" href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></h3>

          {{-- {{$searchResult->searchable->item->cost_price}} --}}
            </h1>
       </ul>
   @endforeach
@endforeach
@endsection


