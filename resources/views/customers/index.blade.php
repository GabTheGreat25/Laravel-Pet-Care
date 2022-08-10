@extends('html.usermaster')
@section('title')
Customer That Is Deactivated
@endsection
@section('contents')
<div>
    <h1 style="text-align:
            center; font-weight: 700; padding-bottom: 1rem;">
        Customer That Is Deactivated
    </h1>
</div>
<div class="py-3">
    <table class="table table-bordered table-striped table-hover">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Title</th>
            <th class="w-screen text-3xl">First Name</th>
            <th class="w-screen text-3xl">Last Name</th>
            <th class="w-screen text-3xl">Age</th>
            <th class="w-screen text-3xl">Address</th>
            <th class="w-screen text-3xl">Sex</th>
            <th class="w-screen text-3xl">Phone Number</th>
            <th class="w-screen text-3xl">Customer Pic</th>
            <th class="w-screen text-3xl">Restore</th>
        </tr>

        @forelse ($customers as $customer)
        <tr>
            @if ($customer->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{ $customer->id }}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{ route('customer.show', $customer->id) }}">{{ $customer->id }}</a>
            </td>
            @endif
            </td>
            <td class="text-center text-3xl">
                {{ $customer->title }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->firstName }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->lastName }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->age }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->address }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->sex }}
            </td>
            <td class="text-center text-3xl">
                {{ $customer->phonenumber }}
            </td>
            <td class="pl-12">
                <img src="{{ asset($customer->img_path) }}" alt="I am A Pic" width="100" height="100">
            </td>

            @if ($customer->deleted_at)
            <td>
                <a class="btn btn-warning" href="{{ route('customer.restore', $customer->id) }}">
                    <p>
                        Restore
                    </p>
                </a>
            </td>
            @else
            <td>
                <a class="btn btn-success" href="#">
                    <p>
                        Restore
                    </p>
                </a>
            </td>
            @endif
        </tr>
        @empty
        <p style="text-align: center; font-size: 2.5rem; font-weight: 900; font-style:italic; color:red;">No Customer
            That Is
            Deactivated</p>
        @endforelse
    </table>

    <div>{{ $customers->links() }}</div>
</div>
</div>
@endsection