@extends('html.usermaster')
@section('title')
    Employee Edit
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Update Employees
            </h1>
        </div>
        <div>
            <div>
                {{ Form::model($employees, [
                    'route' => ['employee.update', $employees->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="name">Employee Name</label>
                        {{ Form::text('name', null, [
                            'id' => 'name',
                        ]) }}
                        @if ($errors->has('name'))
                            <p>{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="position">Position</label>
                        {{ Form::text('position', null, [
                            'id' => 'position',
                        ]) }}
                        @if ($errors->has('position'))
                            <p>{{ $errors->first('position') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="address">Address</label>
                        {{ Form::text('address', null, ['id' => 'address']) }}
                        @if ($errors->has('address'))
                            <p>{{ $errors->first('address') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="phonenumber">Phone Number</label>
                        {{ Form::text('phonenumber', null, ['id' => 'phonenumber']) }}
                        @if ($errors->has('phonenumber'))
                            <p>{{ $errors->first('phonenumber') }}</p>
                        @endif
                    </div>

                    <label data-error="wrong" data-success="right" for="img_path"
                        style="display: inline-block;
          width: 150px; ">Employee Image</label>
                    <input type="file" id="img_path" class="form-control validate" name="img_path">

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
