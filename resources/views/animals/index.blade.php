@extends('html.customermaster')
@section('title')
Show Each Pet Of The Customer That Is Log In
@endsection
@section('contents')
<style>
    .dot {
        border: 1px dashed #000;
        width: 105%;
        margin: auto;
        margin-left: -1rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .dot:last-child {
        display: none;
    }
</style>
<div style="padding: 0 2rem;">
    <div>
        <h1 style="text-align:
                center; font-weight: 700;">
            Show All Customer's Pet Who Is Log In
        </h1>
    </div>
    <div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#animalModal">
            Create New animal
        </button>
    </div>

    <div
        style="display:grid; justify-items:center; align-items:center; font-size: 2.5rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 1rem; margin: 0 45rem; border-radius: .75rem; text-align:center;">
        @forelse ($customers as $customer)
        <p> Customer ID: {{ $customer->id }}</p>
        <p> Customer's Name: {{ $customer->title }}. {{ $customer->firstName }}, {{ $customer->lastName }}</p>
        <span>Customer's Image</span>
        <img src="{{ asset($customer->img_path) }}" alt="I am A Pic" width="100" height="100">
    </div>
    <br>
    <div
        style="display:grid; justify-items:center; align-items:center; font-size: 2.5rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 1rem; margin: 0 45rem; border-radius: .75rem; text-align:center;">
        @foreach ($customer->animals as $animal)
        <p> Pet ID: <i style="color:red">{{ $animal->id }} </i></p>
        <p> Pet Name: <i style="color:red">{{ $animal->petName }}</i></p>
        <p> Pet Age: <i style="color:red">{{ $animal->Age }}</i> </p>
        <p> Pet Type: <i style="color:red">{{ $animal->Type }}</i></p>
        <p> Pet Breed: <i style="color:red">{{ $animal->Breed }}</i></p>
        <p> Pet Sex: <i style="color:red">{{ $animal->Sex }}</i></p>
        <p> Pet Color: <i style="color:red">{{ $animal->Color }}</i></p>
        Customer's Pet Image: <img src="{{ asset($animal->img_path) }}" alt="I am A Pic" width="100" height="100">
        <div class="dot"></div>
        @endforeach
        @empty
        <h1 style="text-align:center; font-weight: 700;">
            This Customer Doesn't Have Any Pets
        </h1>
        @endforelse
    </div>
    <br>
    <div class="modal" id="animalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:75%;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p class="modal-title w-100 font-weight-bold">Add New animal</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('mypetstore') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body mx-3" id="inputfacultyModal">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>

                            <div class="md-form mb-5" style="position: absolute; left: -100rem;">
                                <label for="customer">Customer:</label>
                                {!! Form::text(
                                'customer_id',
                                App\Models\Customer::where('user_id', Auth::id())->latest()->pluck('id')->first(),
                                ['readonly'],
                                null,
                                [
                                'class' => 'form-control validate',
                                ],
                                ) !!}
                            </div>

                            <label data-error="wrong" data-success="right" for="petName"
                                style="display: inline-block; width: 150px; ">Pet Name</label>
                            <input type="text" id="petName" class="form-control validate" name="petName">

                            <label data-error="wrong" data-success="right" for="Age"
                                style="display: inline-block; width: 150px; ">Age</label>
                            <input type="text" id="Age" class="form-control validate" name="Age">

                            <label data-error="wrong" data-success="right" for="Type"
                                style="display: inline-block; width: 150px; ">Type</label>
                            <input type="text" id="Type" class="form-control validate" name="Type">

                            <label data-error="wrong" data-success="right" for="Breed"
                                style="display: inline-block; width: 150px; ">Breed</label>
                            <input type="text" id="Breed" class="form-control validate" name="Breed">

                            <div class="form-group">
                                <label for="Sex" class="control-label">{{ __('sex') }}</label>
                                <div class="form-group">
                                    <select class="form-control" name="Sex" value="{{ old('Sex') }}">
                                        @if ($errors->has('Sex'))
                                        <small>{{ $errors->first('Sex') }}</small>>
                                        @endif
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <label data-error="wrong" data-success="right" for="Color"
                                style="display: inline-block; width: 150px; ">Color</label>
                            <input type="text" id="Color" class="form-control validate" name="Color">

                            <label data-error="wrong" data-success="right" for="img_path"
                                style="display: inline-block; width: 150px; ">Animal Image</label>
                            <input type="file" id="img_path" class="form-control validate" name="img_path">

                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection