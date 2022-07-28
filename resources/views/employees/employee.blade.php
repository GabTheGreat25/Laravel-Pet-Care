@extends('html.master')
@section('title')
    Employee Data Table
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
        <form method="post" enctype="multipart/form-data" action="{{ url('/employee/import') }}">
            @csrf
            <input type="file" id="uploadName" name="employee_upload" required>

    </div>

    @error('employee_upload')
        <small>{{ $message }}</small>
    @enderror
    <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
    </form>
    </div>

    <div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#employeeModal">
            create new employee
        </button></div>
    <div>
        {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>
    <div class="modal" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:75%;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p class="modal-title w-100 font-weight-bold">Add New Employee</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('employee') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}  

                    <div class="modal-body mx-3" id="inputfacultyModal">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="name"
                                style="display: inline-block;
          width: 150px; ">Employee Name</label>
                            <input type="text" id="name" class="form-control validate" name="name">

                            <label data-error="wrong" data-success="right" for="position"
                                style="display: inline-block;
          width: 150px; ">Position</label>
                            <input type="text" id="position" class="form-control validate" name="position">
                            <label data-error="wrong" data-success="right" for="address"
                                style="display: inline-block;
          width: 150px; ">Address</label>
                            <input type="text" id="address" class="form-control validate" name="address">
                            <label data-error="wrong" data-success="right" for="phonenumber"
                                style="display: inline-block;
          width: 150px; ">Phone Number</label>
                            <input type="text" id="phonenumber" class="form-control validate" name="phonenumber">
                            <label data-error="wrong" data-success="right" for="image"
                                style="display: inline-block;
          width: 150px; ">Employee Image</label>
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
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection