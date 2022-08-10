@extends('html.usermaster')
@section('contents')

<form class="navbar-form navbar-left" method="POST" role="search" action="{{route('transactionsearch')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Search Customer">
    </div>
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
</form>

<div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
</div>
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
@endsection