@extends('layouts.master')
@section('content')
    <style>
        body {
            margin-top: 20px;

        }



        .align-center {
            text-align: center;
        }

        .hash-list {
            display: block;
            padding: 0;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .hash-list.cols-3>li:nth-last-child(-n+3) {
                /* border-bottom: none; */
            }
        }

        @media (min-width: 768px) {
            .hash-list.cols-3>li {
                /* height: 33.3333%; */
            }
        }

        .hash-list>li {
            display: block;
            float: left;
            background-color: rgba(255, 255, 255, 0.950);
            border-radius: 1rem;
        }

        .pad-30,
        .pad-30-all>* {
            padding: 30px;
        }

        img {
            border: 0;
            border: .1rem solid black;
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

        span {
            padding: 0 4rem;
        }
    </style>
    <div class="container">
        <div class="mgb-40 padb-30 auto-invert line-b-4 align-center">
            <h1 class="font-cond-l fg-accent lts-md mgb-10" contenteditable="false">| -- Admin Information -- |</h1>
            <h1 class="font-cond-b fg-text-d lts-md fs-300 fs-300-xs no-mg" contenteditable="false">Welcome To Pet Care,
                {{ $admin->name }}!</h1>
        </div>
        <div class="center">
            <ul class="hash-list cols-3 cols-1-xs pad-30-all align-center text-sm">
                <li>
                    <p>Admin Image</p>
                    <img src="{{ asset('images/admin/' . $admin->img_path) }}" alt="I am A Pic"
                        class="wpx-100 img-round mgb-20">
                    <div class="text">
                        <span>ID: {{ $admin->id }}</span>
                        <p class="fs-110 font-cond-l " contenteditable="false">
                            Job: {{ $admin->job }}
                        </p>
                        <span>User ID: {{ $admin->user_id }}</span>
                    </div>
                    <p class="info font-cond mgb-5 fg-text-d fs-130" contenteditable="false">Address: {{ $admin->address }}
                    </p>
                    <small class="font-cond case-u lts-sm fs-80 fg-text-l" contenteditable="false">Contact Number:
                        {{ $admin->phonenumber }}</small>
                </li>

            </ul>
        </div>
    </div>
@endsection
