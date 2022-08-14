<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Transaction</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Open Sans;
        }

        section {
            width: 100%;
            display: inline-block;
            background: #333;
            height: 50vh;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            text-decoration: underline;
        }

        .footer-distributed {
            position: relative;
            top: 18rem;
            background: #33383b;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
            box-sizing: border-box;
            width: 100%;
            text-align: left;
            font: bold 16px sans-serif;
            padding: 55px 50px;
        }

        .footer-distributed .footer-left,
        .footer-distributed .footer-center,
        .footer-distributed .footer-right {
            display: inline-block;
            vertical-align: top;
        }

        .footer-right {
            padding-left: 1rem;
        }

        .footer-distributed .footer-left {
            width: 40%;
        }

        .footer-distributed h3 {
            color: #ffffff;
            font: normal 36px 'Open Sans', cursive;
            margin: 0;
        }

        .footer-distributed h3 span {
            color: lightseagreen;
        }

        .footer-distributed .footer-links {
            color: #ffffff;
            margin: 20px 0 12px;
            padding: 0;
        }

        .footer-distributed .footer-links a {
            display: inline-block;
            line-height: 1.8;
            font-weight: 400;
            text-decoration: none;
            color: inherit;
        }

        .footer-distributed .footer-company-name {
            color: white;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
        }

        .footer-distributed .footer-center {
            width: 35%;
        }

        .footer-distributed .footer-center i {
            background-color: #33383b;
            color: #ffffff;
            font-size: 25px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            line-height: 42px;
            margin: 10px 15px;
            vertical-align: middle;
        }

        .footer-distributed .footer-center i.fa-envelope {
            font-size: 17px;
            line-height: 38px;
        }

        .footer-distributed .footer-center p {
            display: inline-block;
            color: #ffffff;
            font-weight: 400;
            vertical-align: middle;
            margin: 0;
        }

        .footer-distributed .footer-center p span {
            display: block;
            font-weight: normal;
            font-size: 14px;
            line-height: 2;
        }

        .footer-distributed .footer-center p a {
            color: lightseagreen;
            text-decoration: none;
            ;
        }

        .footer-distributed .footer-links a:before {
            content: "|";
            font-weight: 300;
            font-size: 20px;
            left: 0;
            color: #fff;
            display: inline-block;
            padding-right: 5px;
        }

        .footer-distributed .footer-links .link-1:before {
            content: none;
        }

        .footer-distributed .footer-right {
            width: 20%;
        }

        .footer-distributed .footer-company-about {
            line-height: 20px;
            color: white;
            font-size: 13px;
            font-weight: normal;
            margin: 0;
        }

        .footer-distributed .footer-company-about span {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-distributed .footer-icons {
            margin-top: 25px;
        }

        .footer-distributed .footer-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            cursor: pointer;
            background-color: #33383b;
            border-radius: 2px;

            font-size: 20px;
            color: #ffffff;
            text-align: center;
            line-height: 35px;

            margin-right: 3px;
            margin-bottom: 5px;
        }

        header {
            background: #666;
            height: 50px;
        }

        #emp {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            color: white;
            font-style: oblique;
            text-align: center;
        }

        #emp td,
        #emp th {
            border: 1px solid white;
            padding: 8px;
        }

        #emp tr:nth-child(even) {
            background-color: rgb(65, 65, 65);
            font-size: 2rem;
        }

        #emp tr:nth-child(odd) {
            background-color: rgb(186, 185, 185);
            font-size: 2rem;
        }

        #emp th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: rgb(49, 49, 49);
            color: white;
        }

        .made {
            display: grid;
            justify-content: end;
            padding-top: 1rem;
            font-size: .55rem;
            font-weight: 900;
            color: white;
        }

        header {
            text-align: center;
            width: 100%;
            height: auto;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
            background: #33383b;
            border-radius: 0 0 85% 85% / 30%;
        }

        header .overlay {
            width: 100%;
            height: 70%;
            padding: 1rem;
            color: #FFF;
            text-shadow: 1px 1px 1px #333;
            background-image: linear-gradient(135deg, #6069c969 10%, #fd5e086b 100%);
        }

        h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 80px;
            margin-bottom: 30px;
        }

        h3,
        p {
            font-family: 'Open Sans', sans-serif;
            margin-bottom: 30px;
        }

        button:hover {
            cursor: pointer;
        }

        .nye {
            text-align: center;
            font-size: 2rem;
            color: white;
        }

        .bruh {
            padding-top: 1rem;
            text-align: center;
            font-size: 4rem;
            color: #666;
        }

        #ded {
            color: lightseagreen;
        }
    </style>
</head>


<body>
    <header>
        <div class="overlay">
            <h1 id="ded">Simply The Best</h1>
            <h3>Reasons for <span id="ded">Choosing US</span> </h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero nostrum quis, odio veniam itaque ullam
                debitis
                qui magnam consequatur ab. Vero nostrum quis, odio veniam itaque ullam debitis qui magnam consequatur
                ab.
            </p>
            <br>
            <h1 class="nye">Thank You For Choosing Us <span id="ded"> {{ Auth::user()->userName }} </span>!</h1>
        </div>
    </header>
    <div>
        <h1 class="bruh">Transaction Details</h1>
    </div>
    <table id="emp">
        <thead>
            <tr>
                <th>Schedule</th>
                <th>Status</th>
                <th>Service</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
            @foreach ($order->items as $item)

            <tr>

                <td>{{ $order->schedule }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $item->servname }}</td>
                <td>{{ $item->price }}</td>


            </tr>
            @endforeach
            @endforeach

        </tbody>
    </table>

    <footer class="footer-distributed">

        <div class="footer-left">

            <h3>Pet<span>Care</span></h3>

            <p class="footer-links">
                <a href="#" class="link-1">Home</a>

                <a href="#">Shop</a>

                <a href="#">Services</a>

                <a href="#">About</a>

                <a href="#">Consultation</a>

                <a href="#">Contact Us</a>
            </p>

            <p class="footer-company-name">Pet Care © 2022</p>
        </div>

        <div class="footer-center">

            <div>
                <p><span>Philippines,</span>Taguig City</p>
            </div>

            <div>
                <p>++63 926 002 4358</p>
            </div>

            <div>
                <p><a href="#">petcare@ayahoo.com</a></p>
            </div>

            <div class="made">
                Made By Gabriel Mendoza & Meantonette Medalla
            </div>
        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About Us</span>
                Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus
                vehicula sit amet.
            </p>

        </div>



    </footer>
</body>

</html>