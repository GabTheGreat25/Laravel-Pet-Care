@extends('html.usermaster')
@section('title')
Consultation Show
@endsection
@section('contents')
<style>
    .dot {
        border: 1px dashed #000;
        width: 103.5%;
        margin: auto;
        margin-left: -1rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .dot:last-child {
        display: none;
    }

</style>
<div>
    <div>
        <h1 style="text-align:
                    center; font-weight: 700;">
            Consultations
        </h1>
    </div>

    <div style="display:grid; justify-items:center; align-items:center; font-size: 2.5rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 1rem; margin: 0 45rem; border-radius: .75rem; text-align:center;">
        @forelse ($animals as $animal)
        <p> Pet Name: {{ $animal->petName }}</p>
        {{-- <span>Pet Image</span> --}}
        <img src="{{ asset($animal->img_path) }}" alt="Pet Image" style = "border-radius: 50%;  border: 1px solid rgb(90, 52, 22); padding: 5px; " width="100" height="100">
    </div>
    <br>

    <div style="display:grid; justify-items:center; align-items:center; font-size: 1.75rem; font-weight: 700; background-color: rgba(173, 128, 79, 0.753); padding: 3rem 2rem; margin: 0 30rem; border-radius: .75rem; text-align:justify;">
        @foreach ($animal->consultations as $consult)
        Consultation ID: <p>{{$consult->id}}</p>
        Consultation Date: <p>{{$consult->dateConsult}}</p>
        Fees: <p>{{$consult->fees}}</p>
        Vet comment: <p>{{$consult->comment}}</p>
        @foreach ($consultations as $consult)
        @foreach ($consult->diseases_injuries as $try)
        <p> Type of Disease: {{ $try->title }} </p>
        <p> Disease Description: {{ $try->description }}</p>
        @endforeach
        @endforeach
        @endforeach
        <div class="dot"></div>
        @empty
        <h1 style="text-align:center; font-weight: 700;">
            This Customer Doesn't Have Any Pets
        </h1>
        @endforelse
    </div>
</div>

@endsection
