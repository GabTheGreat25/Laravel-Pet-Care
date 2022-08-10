<div class="header">
    Page <span class="pagenum"></span>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
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
                <td>{{ $order->service_orderinfo_id }}</td>
                <td>{{ Auth::user()->userName }}</td>
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