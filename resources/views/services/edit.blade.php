@extends('html.usermaster')
@section('title')
    Service Edit
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Update Services
            </h1>
        </div>
        <div>
            <div>
                {{ Form::model($services, [
                    'route' => ['service.update', $services->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="servname">Service Name</label>
                        {{ Form::text('servname', null, [
                            'id' => 'servname',
                        ]) }}
                        @if ($errors->has('servname'))
                            <p>{{ $errors->first('servname') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="description">Description</label>
                        {{ Form::text('description', null, [
                            'id' => 'description',
                        ]) }}
                        @if ($errors->has('description'))
                            <p>{{ $errors->first('description') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="price">Price</label>
                        {{ Form::text('price', null, ['id' => 'price']) }}
                        @if ($errors->has('price'))
                            <p>{{ $errors->first('price') }}</p>
                        @endif
                    </div>

                    <label data-error="wrong" data-success="right" for="image"
                        style="display: inline-block;
          width: 150px; ">Service Image</label>
                    <input type="file" id="image" class="form-control validate" name="image">

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
