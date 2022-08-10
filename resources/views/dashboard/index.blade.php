@extends('html.usermaster')
@section('contents')

<div class="container">
    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Pet Diseases/Injuries Chart</h2>
    @if(empty($diseasesinjuriesChart))
        <div ></div>
    @else
          <div>{!! $diseasesinjuriesChart->container() !!}</div>
        {!! $diseasesinjuriesChart->script() !!}
     @endif   
    </div>

        <div  class="col-sm-6 col-md-6">
               <h2>Transaction Chart</h2>
           @if(empty($transactionChart))
               <div ></div>
           @else
                 <div>{!! $transactionChart->container() !!}</div>
               {!! $transactionChart->script() !!}
            @endif   
           </div>
</div>
@endsection
