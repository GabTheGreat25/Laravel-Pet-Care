<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">

    @if(Session::has('cart'))
    <div class="grid justify-center gap-3 w-full">
        <div class="row">
            <div>
                <ul>
                    @foreach($animals as $animals)
                    @foreach($services as $service)
                    <li>
                        <span class="pr-6">{{ $animals['name'] }}</span>
                        <span class="pr-6">{{ $service['price'] }}</span>
                        <div class="btn-group">
                            <a class="btn btn-danger my-2 py-2"
                                href="{{ route('transaction.remove',['id'=>$service['services']['id']]) }}">Remove</a>
                        </div>
                    </li>
                    @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div>
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="grid justify-center">
                <button type="button" class="btn btn-success">Checkout</button>
            </div>
            {{-- {{route ('checkout')}} --}}
        </div>
        @else
        <div class="row">
            <div class="grid justify-center position-absolute top-50">
                <h2 class="text-4xl text-red-700">You don't have any transaction!</h2>
            </div>
        </div>
    </div>
    @endif
</body>

</html>