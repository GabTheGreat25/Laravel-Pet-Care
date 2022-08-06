@extends('html.usermaster')
@section('title')
Consultation Edit
@endsection
@section('contents')
<div>
    <div>
        <h1 style="text-align:
                center; font-weight: 700;">
            Update Consultation
        </h1>
    </div>
    <div class="modal-body mx-3" style="display: grid; justify-content:center;">
        <div class="md-form mb-5">
            <div style="display: inline-block; width: 40rem;">
                {{ Form::model($consultations, [
                'route' => ['consultation.update', $consultations->id],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                ]) }}
                <div>

                    <div>
                        <label for="employee_id">Employee Name Incharged:</label>
                        {!! Form::select(
                        'employee_id',
                        Illuminate\Support\Facades\DB::table('employees')->where('position',
                        'Veterinarian')->pluck('name', 'id'),
                        null,
                        [
                        'id' => 'employee_id',
                        'class' => 'form-control',
                        ],
                        ) !!}
                    </div>

                    <div>
                        <label for="animal_id">Pet Name:</label>
                        {!!
                        Form::select('animal_id', App\Models\Animal::pluck('petName', 'id'), null, [
                        'id' => 'animal_id',
                        'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div>
                        <label for="dateConsult">Date of Consultation:</label>
                        {{ Form::date('dateConsult', null, [
                        'id' => 'dateConsult',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('dateConsult'))
                        <p>{{ $errors->first('dateConsult') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="fees">Fees:</label>
                        {{ Form::text('fees', null, [
                        'id' => 'fees',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('fees'))
                        <p>{{ $errors->first('fees') }}</p>
                        @endif
                    </div>

                    {{-- <div>
                        <label for="disease_injuries_id">Any disease/injury?</label>
                        {!!
                        Form::select('disease_injuries_id', App\Models\diseases_injuries::pluck('title', 'id'),
                        null, [
                        'class' => 'form-control',
                        ]) !!}
                    </div> --}}

                    <div>
                        <label for="comment">Comment:</label>
                        {{ Form::text('comment', null, [
                        'id' => 'comment',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                        @endif
                    </div>


                    <label for="disease_injuries_id">Update the disease/injury of the Pet:</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; padding: 2rem 0;">
                        @foreach ($diseases_injuries as $diseases_injuries_id => $diseases_injuries)
                        <div
                            style="display:grid; grid-auto-flow: row; text-align: center; gap: .5rem; color: blue; font-weight:700;">
                            @if (in_array($diseases_injuries_id, $consultations_diseases_injuries))
                            {!! Form::checkbox('diseases_injuries_id[]',$diseases_injuries_id, true,
                            array('class'=>'form-check-input','id'=>'diseases_injuries')) !!}
                            {!!Form::label('diseases_injuries',
                            $diseases_injuries,array('class'=>'form-check-label')) !!}
                            @else
                            {!! Form::checkbox('diseases_injuries_id[]',$diseases_injuries_id, null,
                            array('class'=>'form-check-input','id'=>'diseases_injuries')) !!}
                            {!!Form::label('diseases_injuries',
                            $diseases_injuries,array('class'=>'form-check-label')) !!}
                            @endif
                        </div>

                        @endforeach
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4"></div>
                        <div class="form-group col-md-4">

                            <label for="disease_injuries_id">Any disease/injury?</label>
                            @foreach($diseases_injuries as $diseases_injuries )

                            <div class="form-check form-check-inline">
                                {{ Form::checkbox('diseases_injuries_id[]',$diseases_injuries->id, null,
                                array('class'=>'form-check-input','id'=>'diseases_injuries')) }}
                                {!!Form::label('diseases_injuries', $diseases_injuries->title
                                ,array('class'=>'form-check-label')) !!}
                            </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <div style="display: grid; grid-template-columns: .5fr .5fr; gap: 2rem; ">
                        <button type="submit" class="btn btn-success">
                            Submit
                        </button>
                        <div style="display: grid; justify-content: center;" class="btn btn-danger">
                            <a href="{{ url()->previous() }}" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @endsection