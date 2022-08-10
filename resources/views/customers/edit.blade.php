@extends('html.usermaster')
@section('title')
Customer Edit
@endsection
@section('contents')
<div>
    <div>
        <h1 style="text-align:
        center; font-weight: 700;">
            Update Customers
        </h1>
    </div>
    <div class="modal-body mx-3" style="display: grid; justify-content:center;">
        <div class="md-form mb-5">
            <div style="display: inline-block; width: 40rem;">
                {{ Form::model($customers, [
                'route' => ['customer.update', $customers->id],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="title">
                            Title</label>
                        {{ Form::text('title', null, [
                        'id' => 'title',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('title'))
                        <p>{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <br>
                    <div>
                        <div>
                            <label for="firstName">First Name</label>
                            {{ Form::text('firstName', null, [
                            'id' => 'firstName',
                            'class' => 'form-control',
                            ]) }}
                            @if ($errors->has('firstName'))
                            <p>{{ $errors->first('firstName') }}</p>
                            @endif
                        </div>
                        <br>
                        <div>
                            <div>
                                <label for="lastName">Last Name</label>
                                {{ Form::text('lastName', null, [
                                'id' => 'lastName',
                                'class' => 'form-control',
                                ]) }}
                                @if ($errors->has('lastName'))
                                <p>{{ $errors->first('lastName') }}</p>
                                @endif
                            </div>
                            <br>
                            <div>
                                <div>
                                    <label for="age">Age</label>
                                    {{ Form::text('age', null, [
                                    'id' => 'age',
                                    'class' => 'form-control',
                                    ]) }}
                                    @if ($errors->has('age'))
                                    <p>{{ $errors->first('age') }}</p>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    <label for="address">Address</label>
                                    {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control']) }}
                                    @if ($errors->has('address'))
                                    <p>{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    <label for="sex">Sex</label>
                                    {!! Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), null, ['id' => 'sex', 'class' => 'form-control',]); !!}
                                    @if ($errors->has('sex'))
                                    <p>{{ $errors->first('sex') }}</p>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    <label for="phonenumber">Phone Number</label>
                                    {{ Form::text('phonenumber', null, ['id' => 'phonenumber', 'class' =>
                                    'form-control']) }}
                                    @if ($errors->has('phonenumber'))
                                    <p>{{ $errors->first('phonenumber') }}</p>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <label data-error="wrong" data-success="right" for="img_path" style="display: inline-block;
          width: 150px; ">Customer Image</label>
        <input type="file" id="img_path" class="form-control validate" name="img_path">

        <div>
            <br>
            <div style="display: grid; grid-template-columns: .5fr .5fr; gap: 2rem; ">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
                <div style="display: grid; justify-content: center;" class="btn btn-danger">
                    <a href="{{ url()->previous() }}" role="button">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
@endsection