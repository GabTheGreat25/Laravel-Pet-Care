<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('src/css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    {{ link_to_route('item.export', 'Export to Excel') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>User Profile {{ Auth::user()->userName }}</h1>
            <hr>
            <h2>Your Receipt</h2>
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
</body>

</html>