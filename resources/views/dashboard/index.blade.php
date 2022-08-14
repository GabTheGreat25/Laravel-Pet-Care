@extends('html.usermaster')
@section('contents')

<section style="background: rgba(255, 255, 255, 0.644); margin: 0 30rem; border-radius: .75rem;">
    <div style="position: relative; padding: 1rem 3rem 3rem; left: 18rem; text-align: center;">
        <div>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h2 style="font-weight: 700;">Pet Diseases/Injuries Chart</h2>
                    @if(empty($diseasesinjuriesChart))
                    <div></div>
                    @else
                    <div>{!! $diseasesinjuriesChart->container() !!}</div>
                    {!! $diseasesinjuriesChart->script() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
