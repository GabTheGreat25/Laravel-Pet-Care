<!DOCTYPE html>
<html>

<head>
    <title>New Listener</title>
</head>

<body>
    <h1>Thank you for registering ! {{ $lname }}, {{ $fname }} </h1>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>
