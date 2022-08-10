@extends('layouts.customermaster')
@section('title')
Customer Receipt
@endsection
@section('content')
<div style="display: grid; justify-content: end;">
    <a href="/customerProfile" class="btn btn-danger"
        style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic;"
        role="button">Go
        Back</a>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 style="text-align: center; font-weight: 700;">Customer Profile {{ Auth::user()->userName }}
        </h1>
        <hr>
        <h2 style="text-align: center; font-weight: 700; padding: 1rem 0;">Your Receipt</h2>
        {{-- {{dd($orders)}} --}}
        @foreach ($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 style="text-align: center;">Transaction Number #{{ $order->service_orderinfo_id }}</h2>
                <ul class="list-group">
                    {{-- {{ dd($order->items)}} --}}
                    @php
                    $total = 0;
                    @endphp
                    @foreach ($order->items as $item)
                    <div>
                        <li class="list-group-item">
                            <span class="badge">${{ $item['price'] }} </span>
                            Service Name: {{ $item['servname'] }}
                            @php
                            $total += $item['price'];
                            @endphp
                            @endforeach
                            {{-- Di pwede pagsamahin dodoble --}}
                            {{-- @foreach ($order->pets as $pet)
                            Customer's Pet Name: <div>{{ $pet['petName'] }}</div>
                            @endforeach --}}
                        </li>
                    </div>
                </ul>
            </div>
            <div class="panel-footer" style="display: grid; justify-content:center;">
                <strong>Total Price: ${{ $total }}</strong>
            </div>
        </div>
        <div
            style="display: grid; justify-content:center; background-color: rgb(26, 228, 26); margin: 0 50rem; padding: 1.5rem 0; border-radius: .75rem;">
            {{ link_to_route('item.export', 'Export to Excel') }}
        </div>
        @endforeach
    </div>
</div>
@endsection