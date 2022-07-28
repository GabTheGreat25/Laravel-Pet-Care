@extends('html.master')
@section('title')
    Sign In
@endsection
@section('contents')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign In</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="" action="{{ route('user.signin') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                    <input type="submit" value="Sign In" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection