@extends('html.usermaster')
@section('contents')
<div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
</div>
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
@endsection