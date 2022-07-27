<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Customer</title>
</head>

<body>
    <h1>Thank you for registering ! {{ $firstName }} {{ $lastName }}</h1>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>
