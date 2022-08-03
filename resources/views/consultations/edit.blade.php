@extends('html.usermaster')
@section('title')
    Consultation Edit
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Update consultations
            </h1>
        </div>
        <div>
            <div>
                {{ Form::model($consultations, [
                    'route' => ['consultation.update', $consultations->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div>

                    <div class="col-md-4"></div>
                    {{-- <div class="form-group col-md-4">
                        <label for="customer">Employee Name Incharged:</label>
                        {!! Form::select('customer_id', $customers, $animal->customer_id, ['class' => 'form-control']) !!}
                    </div> --}}

                    <div class="md-form mb-5">
                        <label for="employee_id">Employee Name Incharged:</label>
                        {!!
                         Form::select('employee_id', App\Models\Employee::pluck('name', 'id'), null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="md-form mb-5">
                        <label for="animal_id">Pet Name:</label>
                        {!!
                         Form::select('animal_id', App\Models\Animal::pluck('petName', 'id'), null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div>
                        <div>
                            <label for="dateConsult">Date of Consultation:</label>
                            {{ Form::text('dateConsult', null, [
                                'id' => 'dateConsult',
                            ]) }}
                            @if ($errors->has('dateConsult'))
                                <p>{{ $errors->first('dateConsult') }}</p>
                            @endif
                        </div>

                        <div>
                            <div>
                                <label for="fees">Fees:</label>
                                {{ Form::text('fees', null, [
                                    'id' => 'fees',
                                ]) }}
                                @if ($errors->has('fees'))
                                    <p>{{ $errors->first('fees') }}</p>
                                @endif
                            </div>

                            <div class="md-form mb-5">
                                <label for="disease_id">Disease:</label>
                                {!!
                                 Form::select('disease_id', App\Models\disease::pluck('title', 'id'), null, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>


                            <div class="md-form mb-5">
                                <label for="injury_id">Injury:</label>
                                {!!
                                 Form::select('injury_id', App\Models\injury::pluck('titles', 'id'), null, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>

                            <div>
                                <div>
                                    <label for="comment">Comment:</label>
                                    {{ Form::text('comment', null, [
                                        'id' => 'comment',
                                    ]) }}
                                    @if ($errors->has('comment'))
                                        <p>{{ $errors->first('comment') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit">
                                        Submit
                                    </button>
                                    <a href="{{ url()->previous() }}" role="button">Cancel</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
