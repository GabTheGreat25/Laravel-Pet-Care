@extends('html.usermaster')
@section('title')
Service Edit
@endsection
@section('contents')
<div>
    <div>
        <h1 style="text-align:
                center; font-weight: 700;">
            Update Services
        </h1>
    </div>
    <div class="modal-body mx-3" style="display: grid; justify-content:center;">
        <div class="md-form mb-5">
            <div style="display: inline-block; width: 40rem;">
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
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('servname'))
                        <p>{{ $errors->first('servname') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="description">Description</label>
                        {{ Form::text('description', null, [
                        'id' => 'description',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('description'))
                        <p>{{ $errors->first('description') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="price">Price</label>
                        {{ Form::text('price', null, ['id' => 'price', 'class' => 'form-control',]) }}
                        @if ($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <label data-error="wrong" data-success="right" for="img_path" style="display: inline-block;
          width: 150px; ">Service Image</label>
        <input type="file" id="img_path" class="form-control validate" name="img_path">
        <br>
        <div style="display: grid; grid-template-columns: .5fr .5fr; gap: 2rem; ">
            <button type="submit" class="btn btn-success">
                Submit
            </button>
            <div style="display: grid; justify-content: center;" class="btn btn-danger">
                <a href="{{ url()->previous() }}" role="button">Cancel</a>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
@endsection