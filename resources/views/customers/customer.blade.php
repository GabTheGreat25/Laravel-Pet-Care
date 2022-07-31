@extends('html.master')
@section('title')
    Customer Data Table
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
    <div class="col-xs-6">
        <form method="post" enctype="multipart/form-data" action="{{ url('/customer/import') }}">
            @csrf
            <input type="file" id="uploadName" name="customer_upload" required>

    </div>

    @error('customer_upload')
        <small>{{ $message }}</small>
    @enderror
    <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
    </form>
    </div>

    <div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#customerModal">
            Create New Customer
        </button></div>
    <div>
        {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>
    <div class="modal" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:75%;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p class="modal-title w-100 font-weight-bold">Add New customer</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('customer') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body mx-3" id="inputfacultyModal">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>

                            <label data-error="wrong" data-success="right" for="role"
                                style="display: inline-block; width: 150px; ">Role</label>
                            <input type="text" id="role" class="form-control validate" name="role"
                                value="customer" readonly>

                            <label data-error="wrong" data-success="right" for="email"
                                style="display: inline-block; width: 150px; ">Email</label>
                            <input type="email" id="email" class="form-control validate" name="email">

                            <label data-error="wrong" data-success="right" for="password"
                                style="display: inline-block; width: 150px; ">Password</label>
                            <input type="password" id="password" class="form-control validate" name="password">

                            <label data-error="wrong" data-success="right" for="title"
                                style="display: inline-block; width: 150px; ">Title</label>
                            <input type="text" id="title" class="form-control validate" name="title">

                            <label data-error="wrong" data-success="right" for="firstName"
                                style="display: inline-block; width: 150px; ">First Name</label>
                            <input type="text" id="firstName" class="form-control validate" name="firstName">

                            <label data-error="wrong" data-success="right" for="lastName"
                                style="display: inline-block; width: 150px; ">Last Name</label>
                            <input type="text" id="lastName" class="form-control validate" name="lastName">

                            <label data-error="wrong" data-success="right" for="age"
                                style="display: inline-block; width: 150px; ">Age</label>
                            <input type="text" id="age" class="form-control validate" name="age">

                            <label data-error="wrong" data-success="right" for="address"
                                style="display: inline-block; width: 150px; ">Address</label>
                            <input type="text" id="address" class="form-control validate" name="address">

                            <label data-error="wrong" data-success="right" for="phonenumber"
                                style="display: inline-block; width: 150px; ">Phone Number</label>
                            <input type="text" id="phonenumber" class="form-control validate" name="phonenumber">

                            <label data-error="wrong" data-success="right" for="sex"
                                style="display: inline-block; width: 150px; ">Sex</label>
                            <div class="form-group">
                                <select class="form-control validate" name="sex" id="sex">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <label data-error="wrong" data-success="right" for="img_path"
                                style="display: inline-block; width: 150px; ">Customer Image</label>
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
        {{ $dataTable->scripts() }}
    @endpush
@endsection
