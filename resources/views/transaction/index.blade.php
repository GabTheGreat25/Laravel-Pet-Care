<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

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
        @foreach ($animals->chunk(1) as $serviceChunk)
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach ($serviceChunk as $animal)
            <img src="{{ asset($animal->img_path)}}" alt="I am A Pic" width="400" style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $animal->petName }}
                </h5>
                <p class="mb-2 text-lg font-bold">{{ $animal->Breed }}</p>
                <div class="grid grid-flow-col gap-2">
                    <a href=" {{ route('transaction.addAnimal', ['id'=>$animal->id]) }} " class="btn btn-primary"
                        role="button"><i class="fas fa-cart-plus"></i> Add Animal</a>

                    <a href="#" class="btn btn-success" role="button">More Info</a>
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
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