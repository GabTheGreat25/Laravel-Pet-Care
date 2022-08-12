<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Transaction</title>
    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid white;
            padding: 8px;
        }

        #emp tr:nth-child(even){
            background-color: rgb(244, 212, 184);
        }

        #emp th{
            padding-top:  12px;
            padding-bottom:  12px;
            text-align: center;
            background-color: rgb(122, 91, 57);
            color: white;
        }

        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <body>
    <div >
        <h1>Customer: {{ Auth::user()->userName }}</h1>
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
            {{-- @foreach ($order->pets as $pet) --}}
            <tr>
    
                <td>{{ $order->schedule }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $item->servname }}</td>
                <td>{{ $item->price }}</td>
    
                {{-- <td>{{ $pet->petName }}</td> --}}
            </tr>
    
            @endforeach
            @endforeach
            {{-- @endforeach --}}
        </tbody>
    </table>
</body>
</html>
