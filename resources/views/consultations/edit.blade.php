@extends('layouts.usermaster')
@section('content')
{{-- <div class="container" style="background-color:rgba(206, 175, 152, 0.701); color:black; padding: 75px 1em 50px 1em;"> --}}
  <h2>Edit Consultation Form &#128203;</h2>

  {{ Form::model($consultations,['route' => ['consultations.update',$consultations->id],'method'=>'PUT',
  'enctype'=>'multipart/form-data']) }} 

    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
      <label for="id">Employee Name Incharged:</label><i style="color:red">*</i>
      {!! Form::select('id',$employees, $consultations->id,['class' => 'form-control']) !!}
    </div>


    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
    <label for="dateConsult" class="control-label">Date of Consultation: </label><i style="color:red">*</i>
    {{ Form::text('dateConsult',null,array('class'=>'form-control','id'=>'dateConsult')) }} 
    @if($errors->has('dateConsult'))
    <small>{{ $errors->first('dateConsult') }}</small>
    @endif
    </div>

    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
    <label for="fees" class="control-label">Consultation Fee: </label><i style="color:red">*</i>
    {{ Form::text('fees',null,array('class'=>'form-control','id'=>'fees')) }} 
    @if($errors->has('fees')) {{-- Without null di gagana yan error class for css class and rescuers id para alam ni laravel kanino siya babase --}}
    <small>{{ $errors->first('fees') }}</small>
    @endif
  </div> 

  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
  <label for="comment" class="control-label">Observations/Comments: </label><i style="color:red">*</i>
  {{ Form::text('comment',null,array('class'=>'form-control','id'=>'comment')) }}
  @if($errors->has('comment'))
  <small>{{ $errors->first('comment') }}</small>
  @endif

</div>

<div >
<button type="submit" class="btn btn-primary" onclick="return confirm('Consultation updated!')">Update &#128233;</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>  
  
</div> 
</div>

{!! Form::close() !!} 
@endsection