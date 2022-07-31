@extends('html.customermaster')
@section('title')
    Customer Edit
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Update customers
            </h1>
        </div>
        <div>
            <div>
                {{ Form::model($customers, [
                    'route' => ['customer.update', $customers->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="title">Title</label>
                        {{ Form::text('title', null, [
                            'id' => 'title',
                        ]) }}
                        @if ($errors->has('title'))
                            <p>{{ $errors->first('title') }}</p>
                        @endif
                    </div>

                    <div>
                        <div>
                            <label for="firstName">First Name</label>
                            {{ Form::text('firstName', null, [
                                'id' => 'firstName',
                            ]) }}
                            @if ($errors->has('firstName'))
                                <p>{{ $errors->first('firstName') }}</p>
                            @endif
                        </div>

                        <div>
                            <div>
                                <label for="lastName">Last Name</label>
                                {{ Form::text('lastName', null, [
                                    'id' => 'lastName',
                                ]) }}
                                @if ($errors->has('lastName'))
                                    <p>{{ $errors->first('lastName') }}</p>
                                @endif
                            </div>


                            <div>
                                <div>
                                    <label for="age">Age</label>
                                    {{ Form::text('age', null, [
                                        'id' => 'age',
                                    ]) }}
                                    @if ($errors->has('age'))
                                        <p>{{ $errors->first('age') }}</p>
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
                        <label for="sex">Sex</label>
                        {{ Form::text('sex', null, [
                            'id' => 'sex',
                        ]) }}
                        @if ($errors->has('sex'))
                            <p>{{ $errors->first('sex') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="phonenumber">Phone Number</label>
                        {{ Form::text('phonenumber', null, ['id' => 'phonenumber']) }}
                        @if ($errors->has('phonenumber'))
                            <p>{{ $errors->first('phonenumber') }}</p>
                        @endif
                    </div>

                    <label data-error="wrong" data-success="right" for="image"
                        style="display: inline-block;
          width: 150px; ">Customer Image</label>
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
