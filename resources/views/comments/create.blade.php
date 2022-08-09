@extends('layouts.guestmaster')
@section('content')

<form method="post" action="{{route('comments.store')}}" enctype="multipart/form-data" >
    @csrf

    <style>
body{
    margin-top:20px;
    background-color:#e9ebee;
}

.be-comment-block {
    margin-bottom: 50px !important;
    border: 1px solid #edeff2;
    border-radius: 2px;
    padding: 50px 70px;
    border:1px solid #ffffff;
}

.comments-title {
    font-size: 16px;
    color: #262626;
    margin-bottom: 15px;
    font-family: 'Conv_helveticaneuecyr-bold';
}

.be-img-comment {
    width: 60px;
    height: 60px;
    float: left;
    margin-bottom: 15px;
}

.be-ava-comment {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.be-comment-content {
    margin-left: 80px;
}

.be-comment-content span {
    display: inline-block;
    width: 49%;
    margin-bottom: 15px;
}

.be-comment-name {
    font-size: 13px;
    font-family: 'Conv_helveticaneuecyr-bold';
}

.be-comment-content a {
    color: #383b43;
}

.be-comment-content span {
    display: inline-block;
    width: 49%;
    margin-bottom: 15px;
}

.be-comment-time {
    text-align: right;
}

.be-comment-time {
    font-size: 11px;
    color: #b4b7c1;
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
    font-size: 13px;
    line-height: 50px;
    font-weight: 400;
    color: #b4b7c1;
    width: 100%;
    height: 50px;
    padding-left: 20px;
    padding-right: 20px;
    border: 1px solid #edeff2;
    border-radius: 3px;
}

.form-group.fl_icon .form-input {
    padding-left: 70px;
}

.form-group textarea.form-input {
    height: 150px;
}
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
    <div class="be-comment-block"> 
    <div class="be-comment-content">

    <div class="form-group">
        <label for="service_id" class="control-label">Service:</label><i style="color:red">*</i>
          <select class="form-control" name="service_id" id="servname">
            @foreach($services as $id => $service)
              <option value="{{$id}}">{{$service}}</option>
            @endforeach
          </select>
        </div>

        {{-- <label data-error="wrong" data-success="right" for="role"
        style="display: inline-block; width: 150px; ">Role</label>
    <input type="text" id="role" class="form-control validate" name="role"
        value="customer" readonly> --}}

                    {{-- <div style="display: inline-block; width: 40rem;">
                        {{ Form::model($service, [
                        'route' => ['service.addComment', $service->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                        ]) }}
                        <div> --}}

        <form class="form-block">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group fl_icon">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <input class="form-input" type="text" placeholder="Your name" id="guestName" name="guestName">
                    </div>
                </div>
    
                <div class="col-xs-12 col-sm-6 fl_icon">
                    <div class="form-group fl_icon">
                        <div class="icon"><i class="fa fa-envelope-o"></i></div>
                        <input class="form-input" type="text" placeholder="Your email" id="gEmail" name="gEmail">
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group fl_icon">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <input class="form-input" type="text" placeholder="Cellphone Number" id="cellnum" name="cellnum">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group fl_icon">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <input class="form-input" type="text" placeholder="Age" id="age" name="age">
                            </div>
                        </div>

                    {{-- <div class="col-xs-12 col-sm-6 fl_icon">
                        <div class="form-group fl_icon">
                            <div class="icon"><i class="fa fa-envelope-o"></i></div>
                            <input class="form-input" type="text" placeholder="Age" id="age" name="age">
                        </div>
                    </div> --}}

                <div class="col-xs-12">									
                    <div class="form-group">
                        <textarea class="form-input" required="" placeholder="Comment" id="gcomment" name="gcomment"></textarea>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-primary" onclick="return confirm('Do you want to add this comment?')">Save &#128190;</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a> 
                {{-- <a class="btn btn-primary pull-right">submit</a> --}}
            </div>
        </form>
	
</div>
</div>
</div>     
</div>
</form> 
@endsection