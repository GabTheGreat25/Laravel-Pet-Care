@extends('layouts.usermaster')
@section('title')
New Consultation
@endsection
@section('content')
{{-- <div class="container" style="background-color:rgba(206, 175, 152, 0.701); color:black; padding: 75px 1em 50px 1em;"> --}}
  
  <h2>Pet health consultation &#128203;</h2>

  <form method="post" action="{{route('consultations.store')}}" enctype="multipart/form-data" >
    @csrf
    
    <div class="form-group">
    
    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="id" class="control-label">Employee Name Incharged:</label><i style="color:red">*</i>
          <select class="form-control" name="employee_id" id="name">
            @foreach($employees as $id => $employee)
              <option value="{{$id}}">{{$employee}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="id" class="control-label">Animal Name:</label><i style="color:red">*</i>
              <select class="form-control" name="animal_id" id="petName">
                @foreach($animals as $id => $animal)
                  <option value="{{$id}}">{{$animal}}</option>
                @endforeach
              </select>
         </div>

         <div class="col-md-4"></div>
         <div class="form-group col-md-4">
            <label for="dateConsult" class="control-label">Date of Consultation:</label><i style="color:red">*</i>
            <input type="date" class="form-control" id="dateConsult" name="dateConsult" value="2022-01-01"
            min="2000-01-01" max="2030-12-31" value="{{old('dateConsult')}}">@if($errors->has('dateConsult'))
            <small>{{ $errors->first('dateConsult') }}</small>
           @endif 
          </div>


          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="fees" class="control-label">Consultation Fee:</label> <i style="color:red">*</i>
            <input type="text" class="form-control" id="fees" name="fees" value="{{old('fees')}}">@if($errors->has('fees'))
            <small>{{ $errors->first('fees') }}</small> 
           @endif 
          </div> 

         

          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="id" class="control-label">Any Disease? </label><i style="color:red">*</i>
              <select class="form-control" name="disease_id" id="title">
                @foreach($diseases as $id => $disease)
                  <option value="{{$id}}">{{$disease}}</option>
                @endforeach
              </select>
            </div>
      
            {{-- <div class="md-form mb-5">
                <label for="id">Any Disease? </label>
                {!! Form::select('disease_id', App\Models\disease::pluck('title', 'id'), null, [
                    'class' => 'form-control',
                ]) !!}
            </div> --}}

            {{-- <div class="md-form mb-5">
                <label for="id">Any Injuries? </label>
                {!! Form::select('injury_id', App\Models\injury::pluck('titles', 'id'), null, [
                    'class' => 'form-control',
                ]) !!}
            </div> --}}

            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="id" class="control-label">Any Injuries? </label><i style="color:red">*</i>
                  <select class="form-control" name="injury_id" id="titles">
                    @foreach($injuries as $id => $injury)
                      <option value="{{$id}}">{{$injury}}</option>
                    @endforeach
                  </select>
                </div>
          
        
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="comment" class="control-label">Observations/Comments: </label> <i style="color:red">*</i> 
                    <input type="text" class="form-control" id="comment" name="comment" value="{{old('comment')}}">@if($errors->has('comment'))
                    <small>{{ $errors->first('comment') }}</small> 
                   @endif 
                  </div> 

<button type="submit" class="btn btn-primary" onclick="return confirm('Do you want to add this consultation?')">Save &#128190;</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a> 
  </div>     
</div>
</div>
</form> 

@endsection