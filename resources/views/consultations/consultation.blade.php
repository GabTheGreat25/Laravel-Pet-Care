@extends('html.usermaster')
@section('contents')

<div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#listenerModal">
        create new consultation
    </button></div>

<form class="navbar-form navbar-left" method="POST" role="search" action="{{route('petsearch')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Search Animal">
    </div>
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
</form>
</li>

<div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
</div>

<div class="modal" id="listenerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <p class="modal-title w-100 font-weight-bold">Add new consultation </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{url('consultation')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <div>
                            {{-- <label for="employee_id">Veterinarian Incharged:</label> --}}
                            {{-- {!!
                            Form::select('employee_id', App\Models\Employee::pluck('name', 'id'), null, [
                            'class' => 'form-control',
                            ]) !!} --}}

                            {{-- {!! Form::select(
                            'employee_id',
                            Illuminate\Support\Facades\DB::table('employees')->where('position',
                            'Veterinarian')->pluck('name', 'id'),
                            null,
                            [
                            'class' => 'form-control',
                            ],
                            ) !!} --}}
                            <div class="md-form mb-5" style="position: absolute; left: -100rem;">
                                {{-- <label for="customer">Customer:</label> --}}
                                {!! Form::text(
                                'employee_id',
                                App\Models\Employee::where('position','Veterinarian')->orWhere('user_id',
                                Auth::id())->latest()->pluck('id')->first(),
                                ['readonly'],
                                null,
                                [
                                'class' => 'form-control',
                                ],
                                ) !!}

                            </div>
                        </div>
                        <br>
                        <div>
                            <label for="animal_id">Pet Name:</label>
                            {!!
                            Form::select('animal_id', App\Models\Animal::pluck('petName', 'id'), null, [
                            'class' => 'form-control',
                            ]) !!}
                        </div>
                        <br>
                        <div>
                            <label data-error="wrong" data-success="right" for="dateConsult"
                                style="display: inline-block; width: 150px; ">Date of Consultation:</label>
                            <input type="date" class="form-control" id="dateConsult" name="dateConsult"
                                value="2022-01-01" min="2000-01-01" max="2030-12-31">
                        </div>
                        <br>
                        <div>
                            <label data-error="wrong" data-success="right" for="fees"
                                style="display: inline-block; width: 150px; ">Fees:</label>
                            <input type="text" id="fees" class="form-control validate" name="fees">
                        </div>
                        <br>
                        <div>
                            <label data-error="wrong" data-success="right" for="comment"
                                style="display: inline-block; width: 150px; ">Comment:</label>
                            <input type="text" id="comment" class="form-control validate" name="comment">
                        </div>
                        <br>
                        <label for="disease_injuries_id">Any disease/injury?</label>
                        <div style="display:grid; grid-auto-flow:column; padding: 1rem 0;">
                            @foreach($diseases_injuries as $diseases_injuries )

                            <div class="form-check form-check-inline">
                                {{ Form::checkbox('diseases_injuries_id[]',$diseases_injuries->id, null,
                                array('class'=>'form-check-input','id'=>'diseases_injuries')) }}
                                {!!Form::label('diseases_injuries', $diseases_injuries->title
                                ,array('class'=>'form-check-label')) !!}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- <div>
                    <label for="disease_injuries_id">Any disease/injury?</label>
                    {!!
                    Form::select('disease_injuries_id', App\Models\diseases_injuries::pluck('title', 'id'), null, [
                    'class' => 'form-control',
                    ]) !!}
                </div> --}}


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