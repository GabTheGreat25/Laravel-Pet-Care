<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

    @foreach($services->chunk(5) as $iService)
    <div class="row">
        @foreach($iService as $service)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ asset($service->img_path) }}" width="100" height="100" class="img-circle">
                <h3>
                    <strong><span>{{$service->servname}}</span></strong>
                </h3>
                <h3>
                    <strong><span>{{$service->description}}</span></strong>
                </h3>
                <h3>
                    <strong><span>{{$service->price}}</span></strong>
                </h3>

                <a href="{{route('comments.viewComment',$service->id)}}" class="btn btn-primary" role="button">View
                    Details</a>

            </div>
            <div class="caption">

            </div>
        </div>
        {{--
    </div> --}}
    @endforeach
    @endforeach
</body>