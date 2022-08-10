<div>
    <h1>Customer: {{ Auth::user()->userName }}</h1>
</div>
<table>
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