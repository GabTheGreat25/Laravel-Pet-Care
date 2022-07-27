@extends('html.master')
@section('title')
    animal Edit
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Update animals
            </h1>
        </div>
        <div>
            <div>
                {{ Form::model($animals, [
                    'route' => ['animal.update', $animals->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div>

                    {{-- <div class="col-md-4"></div>
                         <div class="form-group col-md-4">
                          <label for="id">Customer:</label><i style="color:red">*</i>
                          {!! Form::select('id',$customers, $animals->id,['class' => 'form-control']) !!}
                        </div> --}}

                    <div>
                        <div>
                            <label for="petName">Pet Name</label>
                            {{ Form::text('petName', null, [
                                'id' => 'petName',
                            ]) }}
                            @if ($errors->has('petName'))
                                <p>{{ $errors->first('petName') }}</p>
                            @endif
                        </div>

                        <div>
                            <div>
                                <label for="Age">Age</label>
                                {{ Form::text('Age', null, [
                                    'id' => 'Age',
                                ]) }}
                                @if ($errors->has('Age'))
                                    <p>{{ $errors->first('Age') }}</p>
                                @endif
                            </div>


                            <div>
                                <div>
                                    <label for="Type">Type</label>
                                    {{ Form::text('Type', null, [
                                        'id' => 'Type',
                                    ]) }}
                                    @if ($errors->has('Type'))
                                        <p>{{ $errors->first('Type') }}</p>
                                    @endif
                                </div>

                    <div>
                        <label for="Breed">Breed</label>
                        {{ Form::text('Breed', null, ['id' => 'Breed']) }}
                        @if ($errors->has('Breed'))
                            <p>{{ $errors->first('Breed') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="Sex">Sex</label>
                        {{ Form::text('Sex', null, [
                            'id' => 'Sex',
                        ]) }}
                        @if ($errors->has('Sex'))
                            <p>{{ $errors->first('Sex') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="Color">Color</label>
                        {{ Form::text('Color', null, ['id' => 'Color']) }}
                        @if ($errors->has('Color'))
                            <p>{{ $errors->first('Color') }}</p>
                        @endif
                    </div>

                    <label data-error="wrong" data-success="right" for="image"
                        style="display: inline-block;
          width: 150px; ">animal Image</label>
                    <input type="file" id="image" class="form-control validate" name="image">

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
