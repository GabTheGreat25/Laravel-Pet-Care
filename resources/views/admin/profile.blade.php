@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>user profile</h1>
            <div>
                 ID <p>{{ $admin->id }}</p>
                 User ID <p>{{ $admin->user_id }}</p>
                  Name<p>{{ $admin->name }}</p>
                  Job<p>{{ $admin->job }}</p>
                  Address<p>{{ $admin->address }}</p>
                  phonenumber<p>{{ $admin->phonenumber }}</p>
                  Address<p>{{ $admin->address }}</p>

            </div>
         
        </div>
    </div>
@endsection
