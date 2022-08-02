@extends('html.master')
@section('title')
    Customer That Is Deactivated
@endsection
@section('contents')
    <div class="py-3">
        <table class="table-auto text-center">
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
                <th class="w-screen text-3xl">Destroy</th>
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
                            <a href="{{ route('customer.restore', $customer->id) }}">
                                <p class="text-center text-red-700 text-2xl bg-purple-500 p-2 my-2">
                                    Restore &rarr;
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="#">
                                <p class="text-center text-2xl bg-purple-500 p-2 my-2">
                                    Restore &rarr;
                                </p>
                            </a>
                        </td>
                    @endif

                    <td>
                        <form action="customer/{{ $blog->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @empty
                <p>No Customer That Is Deactivated</p>
            @endforelse
        </table>

        <div class="pt-6 px-4">{{ $customers->links() }}</div>
    </div>
    </div>
@endsection
