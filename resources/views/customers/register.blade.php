<body style="background-image: url(infos.png); background-size:cover;"></body>
@extends('layouts.customermaster')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Information</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form class="" action="{{ route('customer.register') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Title: </label><i style="color:red">*</i>
                        <input type="text" name="title" id="title" class="form-control">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="firstName">First Name: </label><i style="color:red">*</i>
                        <input type="text" name="firstName" id="firstName" class="form-control">
                        @error('firstName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="lastName">Last Name: </label><i style="color:red">*</i>
                        <input type="text" name="lastName" id="lastName" class="form-control">
                        @error('lastName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="age">Age: </label><i style="color:red">*</i>
                        <input type="text" name="age" id="age" class="form-control">
                        @error('age')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address: </label><i style="color:red">*</i>
                        <input type="text" name="address" id="address" class="form-control">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex" class="control-label">{{ __('sex') }}</label><i style="color:red">*</i>
                        <div class="form-group">
                            <select class="form-control" name="sex" value="{{ old('sex') }}">
                                @if ($errors->has('sex'))
                                    <small>{{ $errors->first('sex') }}</small>>
                                @endif
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phonenumber">Phone number: </label><i style="color:red">*</i>
                        <input type="text" name="phonenumber" id="phonenumber" class="form-control">
                        @error('phonenumber')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="img_path" class="control-label">Customer Profile:</label><i style="color:red"></i>
                        <input type="file" class="form-control" id="img_path" name="img_path">
                        @error('img_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="Sign Up" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
