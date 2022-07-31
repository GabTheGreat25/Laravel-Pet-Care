@extends('layouts.usermaster')
@section('content')
    <style>
  
  .align-center {
        text-align: center;
    }

    .hash-list {
        display: block;
        padding: 0;
        margin: 0 auto;
    }

    .hash-list>li {
        display: block;
        float: left;
        background-color: rgba(255,237,216);
        border-radius: 1rem;
    }

    .pad-30,
    .pad-30-all>* {
        padding: 30px;
    }

    .img {
        border-radius: 75%;
        border: 1px solid rgb(90, 52, 22);
        padding: 5px;
    }

    .mgb-20,
    .mgb-20-all>* {
        margin-bottom: 20px;
    }

    .wpx-100,
    .wpx-100-after:after {
        width: 25%;
    }

    .img-round,
    .img-rel-round {
        border-radius: 50%;
    }

    .padb-30,
    .padb-30-all>* {
        padding-bottom: 30px;
    }

    .mgb-40,
    .mgb-40-all>* {
        margin-bottom: 40px;
    }

    .align-center {
        text-align: center;
    }

    [class*="line-b"] {
        position: relative;
        padding-bottom: 20px;
        border-color: #E6AF2A;
    }

    .fg-text-d,
    .fg-hov-text-d:hover,
    .fg-active-text-d.active {
        color: #222;
    }

    .font-cond-b {
        font-weight: 700 !important;
    }

    .center {
        display: grid;
        justify-content: center;
        margin-top: -5rem;
        font-size: 3rem;
        color: rgba(0, 0, 0, 0.800);
        font-weight: 700;
    }

    .info {
        font-size: 3rem;
        color: rgba(0, 0, 0, 0.800);
        font-weight: 700;
    }

    .text {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    #spam {
        padding: 0 4rem;
    }

    .container{
        background-color: rgba(173, 128, 79, 0.753);
        width: fit-content;
        height: fit-content;
        padding: 1rem 3rem;
        border-radius: .75rem; 

    }

    </style>

    <div class="container">
        <div class="mgb-40 padb-30 auto-invert line-b-4 align-center">
            <h1 class="font-cond-l fg-accent lts-md mgb-10" contenteditable="false">𝐄𝐦𝐩𝐥𝐨𝐲𝐞𝐞 𝐏𝐫𝐨𝐟𝐢𝐥𝐞</h1>
            <h1 class="font-cond-b fg-text-d lts-md fs-300 fs-300-xs no-mg" contenteditable="false">𝒲𝑒𝓁𝒸𝑜𝓂𝑒 𝓉𝑜 𝒫𝑒𝓉 𝒞𝒶𝓇𝑒,
                <i style="color:rgb(101,109,74)"> {{ $employee->name }}!</i>
        </div>
        <div class="center">
            <ul class="hash-list cols-3 cols-1-xs pad-30-all align-center text-sm">
                <li>
                
                    {{-- <p>Employee Image</p> --}}
                    <img  class="img" src="{{ asset($employee->img_path) }}" alt="I am A Pic"
                     alt="employee Profile" width="200" height="210">
                   
                     <br>
                     <h5>═════════════════════════════════════════</h5>

                        <span id="spam">𝐈𝐃:  <i style="color:rgb(151, 81, 66)">{{ $employee->id }}</i></span>
                   
                        <p class="fs-110 font-cond-l " contenteditable="false">
                            𝐏𝐨𝐬𝐢𝐭𝐢𝐨𝐧: <i style="color:rgb(151, 81, 66)">{{ $employee->position }}</i>
                        </p>
                        <span id="spam">𝐔𝐬𝐞𝐫 𝐈𝐃: <i style="color:rgb(151, 81, 66)"> {{ $employee->user_id }}</i></span>
                    
                    <p class="info font-cond mgb-5 fg-text-d fs-130" contenteditable="false">𝐀𝐝𝐝𝐫𝐞𝐬𝐬:<i style="color:rgb(151, 81, 66)">
                        {{ $employee->address }} </i>
                    </p>
                    <span class="font-cond case-u lts-sm fs-80 fg-text-l" contenteditable="false">𝐂𝐨𝐧𝐭𝐚𝐜𝐭 𝐍𝐮𝐦𝐛𝐞𝐫:<i style="color:rgb(151, 81, 66)">
                        {{ $employee->phonenumber }}</i></span>
                </li>

            </ul>
        </div>
    </div>
@endsection
