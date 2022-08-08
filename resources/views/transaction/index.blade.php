<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    .dot {
        border: 1px dashed #000;
        width: 148%;
        margin: auto;
        margin-left: -6rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .dot:last-child {
        display: none;
    }
</style>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @if ($message = Session::get('error'))
    <div class="bg-red-500 p-4 text-center">
        <strong class="text-white text-3xl pl-4 text-center">{{ $message }}</strong>
    </div>
    @endif
    <div class="pt-8 pb-4 px-8 grid justify-end">
        {{-- <a href="{{ URL('/') }}" class="p-3 border-none italic text-white bg-black text-lg">
            Go Back
        </a> --}}
    </div>
    <h1 class="text-center text-3xl text-white">CHOOSE YOUR PET</h1>
    <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @forelse ($customers as $customer)
            <div style="display:grid; justify-items:center; align-items:center; font-size: 2.5rem; font-weight: 700; padding: 3rem 1rem; margin: 0 5rem; border-radius: .75rem; text-align:center;"
                @foreach ($customer->animals as $animal)

                <p> Pet ID: <i style="color:red">{{ $animal->id }} </i></p>
                <p> Pet Name: <i style="color:red">{{ $animal->petName }}</i></p>
                <p> Pet Age: <i style="color:red">{{ $animal->Age }}</i> </p>
                <p> Pet Type: <i style="color:red">{{ $animal->Type }}</i></p>
                <p> Pet Breed: <i style="color:red">{{ $animal->Breed }}</i></p>
                <p> Pet Sex: <i style="color:red">{{ $animal->Sex }}</i></p>
                <p> Pet Color: <i style="color:red">{{ $animal->Color }}</i></p>
                Customer's Pet Image: <img src="{{ asset($animal->img_path) }}" alt="I am A Pic" width="100"
                    height="100">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; padding: 1rem;">
                    <a href=" {{ route('transaction.addAnimal', ['id'=>$animal->id]) }} " class="btn btn-primary"
                        role="button"><i class="fas fa-cart-plus"></i> Add Animal</a>
                    <div style="display: grid; justify-content: center;" class="btn btn-danger">
                        <a href="#" role="button">More Info</a>
                    </div>
                </div>
                <div class="dot"></div>
                @endforeach
                @empty
                <h1 style="text-align:center; font-weight: 700;">
                    This Customer Doesn't Have Any Pets
                </h1>
                @endforelse
            </div>
    </section>
    <h1 class="text-center text-3xl text-white pt-3">CHOOSE YOUR SERVICE</h1>
    <section class="flex flex-wrap gap-3 justify-center p-12 w-full">
        @foreach ($services->chunk(1) as $serviceChunk)
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach ($serviceChunk as $service)
            @foreach (explode('|', $service->img_path, 3) as $image)
            <img style="max-height: 12rem;" width="400" src="{{$image}}">
            @endforeach
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $service->servname }}
                </h5>
                <p class="mb-2 text-lg font-bold">{{ $service->price }}</p>
                <div class="grid grid-flow-col gap-2">
                    <a href=" {{ route('transaction.addToCart', ['id'=>$service->id]) }} " class="btn btn-primary"
                        role="button"><i class="fas fa-cart-plus"></i> Add Service </a>

                    <a href="#" class="btn btn-success" role="button">View Comment</a>
                    {{-- {{route('transaction.show', ['id'=>$service->id]) }} --}}
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </section>
</body>

</html>