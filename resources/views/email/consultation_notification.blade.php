<!DOCTYPE html>
<html>

<head>
    <title>New Consultation</title>
</head>

<body>
    <h1>Date of Consultation: {{ $dateConsult }}, Total Fee: {{ $fees }}, </h1>
    <h3>Veterinarian Comment: {{ $comment }}</h3>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>