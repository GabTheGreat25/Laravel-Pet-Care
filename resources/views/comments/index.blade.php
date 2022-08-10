<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
    body {
        margin-top: 3rem;
        background-color: #e9ebee;
    }

    .be-comment-block {
        border-radius: 2px;
        padding: 2rem 70px 1rem 70px;
        background-color: #ffffff;
    }

    .comments-title {
        font-size: 16px;
        color: #262626;
        margin-bottom: 15px;
        font-family: 'Conv_helveticaneuecyr-bold';
    }


    .be-comment-content {
        border: 2.5px solid #ced2d7d6;
        padding: 1rem 2rem;
        margin: 2rem 0;
    }

    .be-comment-content span {
        display: inline-block;
        width: 49%;
        margin-bottom: 15px;
    }


    .be-comment-name {
        font-size: 1rem;
        font-weight: 500;
        font-family: 'Conv_helveticaneuecyr-bold';
    }

    .be-comment-time {
        text-align: right;
        font-size: 1rem;
        font-weight: 700;
        color: #b4b7c1;
    }

    .be-comment-text {
        font-size: 1.15rem;
        font-weight: 500;
        color: black;
        display: block;
        background: #f6f6f7;
        border: 1px solid #edeff2;
        padding: 15px 20px 20px 20px;
    }
</style>

<body>
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
                @empty
                <h2 class="text-center text-4xl py-8">NO COMMENTS</h2>
                @endforelse
            </div>
            <div style="display: grid; justify-content: end;">
                <a href="/data" class="btn btn-danger"
                    style="padding: .7rem 1.5rem; font-size: 1rem; font-weight: 500; font-style:italic;"
                    role="button">Go
                    Back</a>
            </div>
        </div>
    </div>
</body>