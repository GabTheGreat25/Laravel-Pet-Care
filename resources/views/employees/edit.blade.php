@extends('html.usermaster')
@section('title')
Employee Edit
@endsection
@section('contents')
<div>
    <div>
        <h1 style="text-align:
                center; font-weight: 700;">
            Update Employees
        </h1>
    </div>
    <div class="modal-body mx-3" style="display: grid; justify-content:center;">
        <div class="md-form mb-5">
            <div style="display: inline-block; width: 40rem;">
                {{ Form::model($employees, [
                'route' => ['employee.update', $employees->id],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="name">Employee Name</label>
                        {{ Form::text('name', null,[
                        'id' => 'name',
                        'class' => 'form-control',
                        'readonly',
                        ]) }}
                        @if ($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <br>
                    <div>
                        <label for="position">Position</label>
                        {!! Form::select('position', array('Veterinarian' => 'Veterinarian', 'Groomer' => 'Groomer',
                        'Assistant' => 'Assistant'), null, ['id' => 'position', 'class' => 'form-control',]); !!}
                        @if ($errors->has('position'))
                        <p>{{ $errors->first('position') }}</p>
                        @endif
                    </div>
                    <br>
                    <div>
                        <label for="address">Address</label>
                        {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'readonly',]) }}
                        @if ($errors->has('address'))
                        <p>{{ $errors->first('address') }}</p>
                        @endif
                    </div>
                    <br>
                    <div>
                        <label for="phonenumber">Phone Number</label>
                        {{ Form::text('phonenumber', null, ['id' => 'phonenumber', 'class' => 'form-control',
                        'readonly',]) }}
                        @if ($errors->has('phonenumber'))
                        <p>{{ $errors->first('phonenumber') }}</p>
                        @endif
                    </div>
                    <br>
                </div>
                {{--
            </div>
        </div> --}}

        {{-- <label data-error="wrong" data-success="right" for="img_path" style="display: inline-block;
          width: 150px; ">Employee Image</label>
        <input type="file" id="img_path" class="form-control validate" name="img_path">
        <br> --}}
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
</div>
@endsection