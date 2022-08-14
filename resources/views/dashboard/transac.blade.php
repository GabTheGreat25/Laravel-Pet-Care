@extends('html.usermaster')
@section('contents')

<section style="padding: 1rem 3rem 3rem 3rem;">
    <div>
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#DateModal">
            Schedule Date
        </button>
    </div>

    <div style="background: rgba(255, 255, 255, 0.644); margin: 0 12rem; border-radius: .75rem;">
        <div style="position: relative; left: 28rem; text-align: center;">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h2 style="font-weight: 700;">Transaction Chart</h2>
                    @if(empty($transactionChart))
                    <div></div>
                    @else
                    <div>{!! $transactionChart->container() !!}</div>
                    {!! $transactionChart->script() !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="modal" id="DateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:75%;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <p class="modal-title w-100 font-weight-bold">Find Scheduled Date</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('dashboard.searchdate') }}">
                        {{ csrf_field() }}

                        <div class="modal-body mx-5" id="inputfacultyModal" style="margin: 4rem;">
                            <div class="md-form mb-5">

                                <div>
                                    <label for="fromDate" class="col-form-label col-sm-2">Schedule date from</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" value="{{ old('fromDate') }}" autocomplete="fromDate" required autofocus />
                                    </div>
                                </div>

                                <div>
                                    <label for="toDate" class="col-form-label col-sm-2">Schedule date to</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control input-sm" id="toDate" name="toDate" value="{{ old('toDate') }}" autocomplete="toDate" required autofocus />
                                    </div>
                                </div>

                                <div style="display: grid; gap: 2rem; grid-auto-flow:column;">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
