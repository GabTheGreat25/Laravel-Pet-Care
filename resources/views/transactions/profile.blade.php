@extends('layouts.customermaster')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 style="text-align: center;">Customer Profile </h1>
        <hr>
        <h2>My Transaction History</h2>
        {{-- {{dd($orders)}} --}}
        @foreach ($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
                <h2>Transaction Number #{{ $order->service_orderinfo_id }}</h2>
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
            <div class="panel-footer">
                <strong>Total Price: ${{ $total }}</strong>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection