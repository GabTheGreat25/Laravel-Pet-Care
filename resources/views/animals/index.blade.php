@extends('html.usermaster')
@section('title')
    Show Each Pet Of The Customer That Is Log In
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Show All Customer's Pet Who Is Log In
            </h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Image</th>
                    <th>Pet ID</th>
                    <th>Customer's Pet Name</th>
                    <th>Customer's Pet Full Info</th>
                    <th>Customer's Pet Image</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <td>{{ $customer->id }}</td>
                    <td> {{ $customer->title }}. {{ $customer->firstName }}, {{ $customer->lastName }}</td>
                    <td> <img src="{{ asset($customer->img_path) }}" alt="I am A Pic" width="100" height="100"></td>
            </tbody>
            @foreach ($customer->animals as $animal)
                <td>{{ $animal->id }} </td>
                <td>{{ $animal->petName }} </td>
                <td>
                    <li> {{ $animal->Age }}</li>
                    <li> {{ $animal->Type }}</li>
                    <li> {{ $animal->Breed }}</li>
                    <li> {{ $animal->Sex }}</li>
                    <li> {{ $animal->Color }}</li>
                </td>
                <td> <img src="{{ asset($animal->img_path) }}" alt="I am A Pic" width="100" height="100"></td>
            @endforeach
        @empty
            <p>The Customer Haven't Added His/Her Pet Yet!</p>
            @endforelse
        </table>
    </div>
@endsection
