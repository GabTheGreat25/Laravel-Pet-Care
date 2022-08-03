@extends('html.customermaster')
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
        <div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#animalModal">
                Create New animal
            </button></div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Customer Image</th>
                        {{-- <th>Pet ID</th>
                        <th>Customer's Pet Name</th>
                        <th>Customer's Pet Full Info</th>
                        <th>Customer's Pet Image</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <td>{{ $customer->id }}</td>
                        <td> {{ $customer->title }}. {{ $customer->firstName }}, {{ $customer->lastName }}</td>
                        <td> <img src="{{ asset($customer->img_path) }}" alt="I am A Pic" width="100" height="100">
                        </td>
                </tbody>

                <thead>
                    <tr>
                        <th>Pet information</th>
                    </tr>
                </thead>
<tbody>
                @foreach ($customer->animals as $animal)
                    <td>Id: <i style= "color:red">{{ $animal->id }} </i></td>
                    <td>Name:  <i style= "color:red">{{ $animal->petName }}</i> </td>
                    <td>
                        <li> Age: <i style= "color:red">{{ $animal->Age }}</i></li>
                        <li> Type: <i style= "color:red">{{ $animal->Type }}</i></li>
                        <li> Breed: <i style= "color:red">{{ $animal->Breed }}</i></li>
                        <li> Sex: <i style= "color:red">{{ $animal->Sex }}</i></li>
                        <li> Color: <i style= "color:red">{{ $animal->Color }}</i></li>
                    </td>
                    <td>Image: <img src="{{ asset($animal->img_path) }}" alt="I am A Pic" width="100" height="100"></td>
                @endforeach
            @empty
                <p>The Customer Haven't Added His/Her Pet Yet!</p>
                @endforelse
            </table>
        </tbody>
            <div class="modal" id="animalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
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
{{-- di ko sure HAHAHHAA HSHAH --}}
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

                                    <label data-error="wrong" data-success="right" for="image"
                                        style="display: inline-block; width: 150px; ">animal Image</label>
                                    <input type="file" id="image" class="form-control validate" name="image">

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
