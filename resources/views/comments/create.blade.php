@extends('layouts.guestmaster')
@section('content')

<form method="post" action="{{route('comments.store')}}" enctype="multipart/form-data">
    @csrf

    <style>
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .be-comment-block {
            /* margin-bottom: 50px !important; */
            margin-top: 7rem;
            background-color: #edeff2;
            border-radius: 2px;
            padding: 1.5rem 8rem 4rem 8rem;
            /* border: 1px solid #ffffff; */
        }

        .be-comment-text {
            font-size: 13px;
            line-height: 18px;
            color: #7a8192;
            display: block;
            background: #f6f6f7;
            border: 1px solid #edeff2;
            padding: 15px 20px 20px 20px;
        }

        .form-group.fl_icon .icon {
            position: absolute;
            top: 1px;
            left: 16px;
            width: 48px;
            height: 48px;
            background: #f6f6f7;
            color: #b5b8c2;
            text-align: center;
            line-height: 50px;
            -webkit-border-top-left-radius: 2px;
            -webkit-border-bottom-left-radius: 2px;
            -moz-border-radius-topleft: 2px;
            -moz-border-radius-bottomleft: 2px;
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
        }

        .form-group .form-input {
            font-size: 1.5rem;
            line-height: 50px;
            font-weight: 400;
            /* color: #b4b7c1; */
            width: 100%;
            height: 50px;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid #edeff2;
            border-radius: 3px;
            outline: none;
        }

        .form-group.fl_icon .form-input {
            padding-left: 70px;
        }

        .form-group textarea.form-input {
            height: 150px;
            outline: none;
        }

        .text {
            text-align: center;
            padding-bottom: 1rem;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div style="display: grid; justify-content: end;">
        <a href="/data" class="btn btn-danger"
            style="padding: .7rem 1.5rem; margin: 6rem 14rem 0 3rem; font-size: 1rem; font-weight: 500; font-style:italic; z-index: 9999;"
            role="button">Home</a>
    </div>
    <div class="container">
        <div class="be-comment-block">
            <div class="be-comment-content">

                <div class="form-group">
                    <h1 class="text">Send Feeback About Our Service!</h1>
                    <div style="position: absolute; left: -100rem;">
                        <select class="form-control" name="service_id" id="servname">
                            @foreach($services as $id => $service)
                            <option value="{{$id}}">{{$service}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <form class="form-block">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input class="form-input" type="text" placeholder="Your name" id="guestName"
                                        name="guestName">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-envelope-o"></i></div>
                                    <input class="form-input" type="email" placeholder="Your email" id="gEmail"
                                        name="gEmail">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input class="form-input" type="text" placeholder="Cellphone Number" id="cellnum"
                                        name="cellnum">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input class="form-input" type="text" placeholder="Age" id="age" name="age">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <textarea class="form-input" required="" placeholder="Comment" id="gcomment"
                                    name="gcomment"></textarea>
                                @if ($errors->has('gcomment'))
                                <p>{{ $errors->first('gcomment') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 10rem 1fr;">
                        <div>
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Do you want to add this comment?')">Save
                                &#128190;
                            </button>
                        </div>
                        <div>
                            <a href="{{url()->previous()}}" class="btn btn-default" style="padding: .7rem 1.5rem;"
                                role="button">Cancel</a>
                        </div>
                    </div>
                </form>

                @endsection