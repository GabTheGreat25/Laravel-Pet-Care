<body style="background-image: url(/navbar/bg.png); background-size:cover;">
@extends('html.usermaster')
@section('title')
Transaction Show
@endsection
@section('contents')
<style>
    .dot {
        border: 1px dashed #000;
        width: 103.5%;
        margin: auto;
        margin-left: -1rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .dot:last-child {
        display: none;
    }

</style>
<div>
    <div>
        <h1 style="text-align:
                    center; font-weight: 700;">
            Transactions
        </h1>
    </div>

    <div style="display:grid; justify-items:center; align-items:center; font-size: 2.5rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 1rem; margin: 0 45rem; border-radius: .75rem; text-align:center;">
        @forelse ($customers as $customer)
        <p> Customer Name: {{ $customer->lastName }}, {{ $customer->firstName }}</p>
        {{-- <span>Customer Image</span> --}}
        <img src="{{ asset($customer->img_path) }}" alt="customer Image" style = "border-radius: 50%;  border: 1px solid rgb(90, 52, 22); padding: 5px; " width="100" height="100">
    </div>
    <br>

    <div style="display:grid; justify-items:center; align-items:center; font-size: 1.75rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 2rem; margin: 0 30rem; border-radius: .75rem; text-align:justify;">
        @foreach ($customer->service_orderinfo as $transaction)
        Transaction ID: <p>{{$transaction->service_orderinfo_id}}</p>
        Scheduled Date: <p>{{$transaction->schedule}}</p>
        Status <p>{{$transaction->status}}</p>
       
        @foreach ($service_orderinfo as $transaction)
        @foreach ($transaction->services as $service)
        <p> Services purchased: {{ $service->servname }} </p>
        @endforeach
        @endforeach
        @endforeach
        <div class="dot"></div>
        @empty
        <h1 style="text-align:center; font-weight: 700;">
            This Customer didn't buy anything
        </h1>
        @endforelse
    </div>
</div>

@endsection
