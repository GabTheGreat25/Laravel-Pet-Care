@extends('html.master')
@section('title')
    Service Data Table
@endsection
@section('contents')
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif
    </div>
    <div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#serviceModal">
            create new service
        </button></div>
    <div>
        {{ $html->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>
    <div class="modal" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:75%;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p class="modal-title w-100 font-weight-bold">Add New Service</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('service') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body mx-3" id="inputfacultyModal">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="servname"
                                style="display: inline-block;
          width: 150px; ">Service Name</label>
                            <input type="text" id="servname" class="form-control validate" name="servname">

                            <label data-error="wrong" data-success="right" for="description"
                                style="display: inline-block;
          width: 150px; ">Description</label>
                            <input type="text" id="description" class="form-control validate" name="description">
                            <label data-error="wrong" data-success="right" for="Price"
                                style="display: inline-block;
          width: 150px; ">Price</label>
                            <input type="text" id="price" class="form-control validate" name="price">
                            <label data-error="wrong" data-success="right" for="img_path"
                                style="display: inline-block;
          width: 150px; ">Service Image</label>
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
    @push('scripts')
        {{ $html->scripts() }}
    @endpush
@endsection
