{{-- listener layout --}}
{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}

{{-- listeners layout --}}
@extends('layouts.usermaster')
@section('contents')

<div class="container">
<br />
    {{-- @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif --}}
     
     @include('partials.search')
     
<table class="table table-striped">
      <tr>{{ link_to_route('consultations.create', 'Add new consultation:')}}</tr>
    <thead>
      <tr>
        <th>Consult ID</th>
        <th>Employee ID</th>
        <th>Date Consult</th>
        <th>Fees</th>
        <th>Comment</th>
        <th>Pet Name</th>
        <th>Disease/Injuries</th>
        <th colspan="2">Action</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
<tbody>

      @foreach($consultations as $consultation)
        <td>{{$consultation->employee_id}}</td>
        <td>{{$consultation->dateConsult}}</td>
        <td>{{$consultation->fees}}</td>
        <td>{{$consultation->comment}}</td>
        <td>{{$consultation->petName}}</td>
        <td>{{$consultation->title}}</td>
        {{-- <li>{{$consultation->album_name}} </li> --}}
        <td>

          </td>

<td><a href="{{action('ListenerController@edit', $listener->id)}}" class="btn btn-warning">Edit</a></td>
       <td>
          <form action=" {{action('ListenerController@destroy', $listener->id)}}" method="post">
           {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            {{-- hidden field ^^ --}}
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
  </tbody>
  </table>
  </div>
  @endsection