<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
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

    <body>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body> 

        <div class="container">
        <div class="be-comment-block">

    <h1 class="comments-title"><i class="fa fa-comments" aria-hidden="true"></i>Comments</h1>

    <h3><a href="{{ route('comments.create') }}" class="btn btn-success" role="button">ADD COMMENT</a></h3>
          
	<div class="be-comment-content">

        @forelse($services as $comment)
        <span class="be-comment-name">
            <a>{{$comment->guestName}} | {{$comment->gEmail}}</a>
            </span>

        <span class="be-comment-time">
            <i class="fa fa-clock-o"></i>
            {{$comment->created_at}}
        </span>

    <p class="be-comment-text">
        {{$comment->gcomment}}
    </p>




{{-- <h1 class="comments-title">Comments (3)</h1>

	<div class="be-comment">
		<div class="be-img-comment">	
			<a href="blog-detail-2.html">
				<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="be-ava-comment">
			</a>
		</div>


		<div class="be-comment-content">
			
				<span class="be-comment-name">
					<a href="blog-detail-2.html">Ravi Sah</a>
					</span>
				<span class="be-comment-time">
					<i class="fa fa-clock-o"></i>
					May 27, 2015 at 3:14am
				</span>

			<p class="be-comment-text">
				Pellentesque gravida tristique ultrices. 
				Sed blandit varius mauris, vel volutpat urna hendrerit id. 
				Curabitur rutrum dolor gravida turpis tristique efficitur.
			</p>
		</div>
	</div>
	 --}}
     @empty
     <h2 class="text-center text-4xl py-8">NO COMMENTS</h2>
     @endforelse

	</div>
</div>
</div>
</div>