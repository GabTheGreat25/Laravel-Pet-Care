@extends('layouts.usermaster')
@section('content')
{{-- <div class="container" width:200%; height:100%; style="background-color:rgba(255, 255, 255, 0.701); color:black; padding: 75px 1em 100px 1em;"> --}}

    <table class="table table-striped">
 
        {{-- <div class="col-md-4 col-md-offset-4"> --}}
           
            <h1>SEARCH RESULT &#128054;</h1>
           
            <h3><a href="{{ route('animals.index') }}" class="button">VIEW ALL ANIMALS DATA &#128106;</a></h3>


            <thead>
                <tr> 
                    {{-- <td>Animal ID</td> --}}
                    <th>Consult ID</th>
                    <th>Employee Incharged</th>
                    <th>Date of Consulted</th>
                    <th>Fees</th>
                    <th>Disease</th>
                    <th>Injury</th>
                    <th>Vet Comment/Observation</th>
                    <th>Animal Photo</th>
                </tr>
            </thead> 
            <tbody>

                @forelse($consultations as $consultation)
    
                 <tr> 
                    {{-- <td>{{$animal->animal_id}}</td>  --}}
                    <td>{{$consultation->id}}</td> 
                    <td>{{$consultation->name}}</td> 
                    <td>{{$consultation->dateConsult}}</td> 
                    <td>{{$consultation->fees}}</td> 
                    <td>{{$consultation->title}}</td> 
                    <td>{{$consultation->titles}}</td> 
                    <td>{{$consultation->comment}}</td> 
                    <td><img src="{{ asset('images/animals/'.$consultation->img_path) }}" style = "border-radius: 50%;  border: 1px solid rgb(90, 52, 22); padding: 5px; " alt="animal Profile" width="120" height="120"/></td> 
                 </tr>
                 @empty
                 <h2 class="text-center text-4xl py-8">THIS PET DOESNT HAVE ANY RECORD </h2>
                 @endforelse
            
           </tbody>
        </table>
        </div>
     </div>
</table>
@endsection  
