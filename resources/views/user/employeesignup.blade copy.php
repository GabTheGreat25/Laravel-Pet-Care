<body style="background-image: url(register.png); background-size:cover;"></body>
@extends('html.master')
@section('title')
    Sign Up
@endsection
@section('contents')
<div class="container" style="background-color:rgba(255, 255, 255, 0.701); color:black; position:center;"></div>

        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up &#128100;</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="" action="{{ route('user.signup') }}" method="POST">
                {{ csrf_field() }}
                
                 <div class="form-group">
                    <label for="username">Username: </label><i style="color:red">*</i>
                    <input type="text" name="username" id="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email: </label><i style="color:red">*</i>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
              
                <div class="form-group">
                    <label for="password">Password: </label><i style="color:red">*</i>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
              
                <div class="form-group">
                    <label for="role" class="control-label">{{ __('role')}}</label><i style="color:red">*</i>
                    <div class="form-group">
                       <select class="form-control" name="role"  value="{{old('role')}}">@if($errors->has('role'))
                        <small>{{ $errors->first('role') }}</small>>
                        @endif 
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>    
                        <option value="customer">Customer</option> 
                       </select>
                     </div>
                 </div>
                        <input type="submit" value="Sign Up" class="btn btn-primary">
                        {{-- <a href="{{url('/adminreg')}}"><button type="button" class="btn btn-outline-primary float-right">BUTTON_NAME</button></a> --}}
             </form>
        </div>
    </div>
@endsection