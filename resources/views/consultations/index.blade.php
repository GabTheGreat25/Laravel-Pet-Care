@extends('layouts.usermaster')
@section('content')
{{-- <div class="container" width:200%; height:100%; style="background-color:rgba(255, 255, 255, 0.701); color:black; padding: 75px 1em 100px 1em;"> --}}

    <table class="table table-striped">
      <a href="{{ route('consultations.create') }}" class="button">&#10133; CREATE NEW CONSULTATION</a>

      <form class="form-inline my-2 my-lg-0" type="get" action="{{ url ('/search') }}" >
        
        <button class="button" type="submit" style="float: right">Search &#x1F50E;</button>
        <input class="form-control mr-sm-2" name= "query" type="search" placeholder="Search pet medical history" style="width: 500px; float: right">
   
      </form>

<thead>
      <tr>
        <th>Consultation ID</th>
        <th>Employee incharged</th>
        <th>Animal Name</th>
        <th>Date of Consultation</th>
        <th>Fee</th>
        <th>Disease</th>
        <th>Injury</th>
        <th>Comment</th>
        
      </tr>
    </thead>
 <tbody>

     @foreach($consultations as $consult)
     <tr>
    
        <td>{{$consult->id}}</td>
        <td>{{$consult->name}}</td> 
        <td>{{$consult->petName}}</td>
        <td>{{$consult->dateConsult}}</td> 
        <td>{{$consult->fees}}</td>
        <td>{{$consult->title}}</td>
        <td>{{$consult->titles}}</td>
        <td>{{$consult->comment}}</td>

        @if($consult->deleted_at)
        <td align="center"><a href="#" class="fa-regular fa-pen-to-square aria-hidden="true style="font-size:20px"> <button style="background-color:#4d4c4a;">&#9997;</a></td></button>

        @else
        <td align="center"><a href="{{ route('consultations.edit',$consult->id) }}" class="fa-regular fa-pen-to-square aria-hidden="true style="font-size:20px"> <button style="background-color:#fae6ae;">&#9997;</a></td></button>
          </td>
          @endif

        <td align="center">{!! Form::open(array('route' => array('consultations.destroy', $consult->id),'method'=>'DELETE')) !!}
        <i class="fa-solid fa-trash-can" style="font-size:20px; color:red" > <button style="background-color:#fae6ae;" onclick="return confirm('Are you sure you want to delete this consultation?')">&#128465;</i></button>
         {!! Form::close() !!}
         </td>
      
         @if($consult->deleted_at)
          <td align="center"><a href="{{ route('consultations.restore',$consult->id) }}" > <i class="fa fa-undo" style="font-size:18px; color:red" disabled="true" onclick="return confirm('Are you sure you want to restore this consultation?')"><button style="background-color:#851414;">&#128260;</i></a></button>
         </td>
      
         @else
       <td align="center"><a href="#" ><i class="fa fa-undo" style="font-size:20px; color:gray" > <button style="background-color:#fae6ae;">&#128260;</i></a></button>
         </td>
         @endif
      
         </tr>
         @endforeach
      </tbody>
      </table>

      </div>
      </div>
    
      @endsection