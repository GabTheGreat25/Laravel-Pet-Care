<body style="background-image: url(bg.png); background-size:cover;">
@extends('html.master')
@section('title')
    Customer Show
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Show customers
            </h1>
        </div>
        @forelse ($customers as $customer)
            <section>
                <div>
                    <img src="{{ asset('images/customers/' . $customer->img_path) }}" alt="I am A Pic" width="100"
                        height="100">
                    <div>
                        <h5>{{ $customer->servname }}</h5>
                        User ID <p>{{ $customer->user_id }}</p>
                        ID <p>{{ $customer->id }}</p>
                        Title<p>{{ $customer->title }}</p>
                        First Name<p>{{ $customer->firstName }}</p>
                        Last Name<p>{{ $customer->lastName }}</p>
                        Age<p>{{ $customer->age }}</p>
                        Address<p>{{ $customer->address }}</p>
                        Sex<p>{{ $customer->sex }}</p>
                        Phone Number<p>{{ $customer->phonenumber }}</p>
                    </div>
                </div>
            </section>
        @empty
            <p>No customer Data in the Database</p>
        @endforelse
        </table>
    </div>
@endsection
