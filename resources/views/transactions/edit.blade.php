@extends('html.usermaster')
@section('title')
Transaction Edit
@endsection
@section('contents')
<div>
    <div>
        <h1 style="text-align:
                center; font-weight: 700;">
            Update Transaction
        </h1>
    </div>
    <div class="modal-body mx-3" style="display: grid; justify-content:center;">
        <div class="md-form mb-5">
            <div style="display: inline-block; width: 40rem;">
                {{ Form::model($transactions, [
                'route' => ['transaction.update', $transactions->service_orderinfo_id],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                ]) }}
                <div>
                    <div>
                        <label for="schedule">Schedule</label>
                        {{ Form::date('schedule', null, [
                        'id' => 'schedule',
                        'class' => 'form-control',
                        ]) }}
                        @if ($errors->has('schedule'))
                        <p>{{ $errors->first('schedule') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="status">Status</label>
                        {!! Form::select('status', array('Not Paid' => 'Not Paid', 'Pending' => 'Pending',
                        'Paid' => 'Paid'), null, ['id' => 'status', 'class' => 'form-control',]); !!}
                        @if ($errors->has('status'))
                        <p>{{ $errors->first('status') }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
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