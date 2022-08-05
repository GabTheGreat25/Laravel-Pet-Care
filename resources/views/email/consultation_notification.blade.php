<!DOCTYPE html>
<html>

<head>
    <title>New Consultation</title>
</head>

<body>
    <h1>Thank you for registering ! {{ $lname }}, {{ $fname }}, </h1>
    <h3>Customer Email: {{ $email }}</h3>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>
