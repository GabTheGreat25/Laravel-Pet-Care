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

<body style="background-image: url(/navbar/bg.png);">
    <div style=" display: grid; justify-content: end;">
        <a href="/customerProfile" class="btn btn-danger"
            style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 1rem; font-weight: 500; font-style:italic;"
            role="button">Go
            Back</a>
    </div>
    @if(Session::has('cart'))
    <div class="grid justify-center gap-3 w-full"
        style="background-color:rgba(255, 255, 255, 0.500); margin: 0 30rem; padding: 3rem 0">
        <div class="row">
            <div>
                <ul>
                    @foreach($animals as $animals)
                    @foreach($services as $service)
                    <li>
                        <span style="font-size: 1.5rem; padding: 0 .5rem; color:black; font-weight: 700;">{{
                            $animals['name'] }}</span>
                        <span style="font-size: 1.5rem; padding: 0 .5rem; color:black; font-weight: 700;">{{
                            $service['price'] }}</span>
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
                {{-- <strong>Total: {{ $totalPrice }}</strong> --}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="grid justify-center">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success" style="color:rgba(0, 0, 0, 0.600);">Checkout</a>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="grid justify-center position-absolute top-50">
            <h2 style="font-size: 2rem; color: red; font-weight: 700;">You don't have any transaction!</h2>
        </div>
    </div>
    </div>
    @endif
</body>

</html>