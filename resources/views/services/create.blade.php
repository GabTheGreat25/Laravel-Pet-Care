@extends('html.master')
@section('title')
    Service Create
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Add Service
            </h1>
        </div>
        <div>

            <div>
                <form action="/service" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div>
                            <label for="servname">Service Name</label>
                            <input type="text" id="servname" name="servname" placeholder="Service Name"
                                value="{{ old('servname') }}">
                            @if ($errors->has('servname'))
                                <p>{{ $errors->first('servname') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" placeholder="Description"
                                value="{{ old('description') }}">
                            @if ($errors->has('description'))
                                <p>{{ $errors->first('description') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" placeholder="Price"
                                value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <p>{{ $errors->first('price') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="img_path">Service Picture</label>
                            <input type="file" id="img_path" name="img_path" value="{{ old('img_path') }}">
                            @if ($errors->has('img_path'))
                                <p>{{ $errors->first('img_path') }}</p>
                            @endif
                        </div>

                        <div>
                            <button type="submit">
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}" role="button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
