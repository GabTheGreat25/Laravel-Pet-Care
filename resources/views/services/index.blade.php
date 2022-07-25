@extends('html.master')
@section('title')
    Service Index
@endsection
@section('contents')
    <div>
        <a href="service/create">
            Add a new service
        </a>
    </div>

    <div>
        <table>
            <tr>
                <th>Id</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Service Picture</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Restore</th>
                <th>Destroy</th>
            </tr>

            @forelse ($services as $service)
                <tr>
                    @if ($service->deleted_at)
                        <td>
                            <a href="#">{{ $service->id }}</a>
                        </td>
                    @else
                        <td>
                            <a href="{{ route('service.show', $service->id) }}">{{ $service->id }}</a>
                        </td>
                    @endif
                    </td>
                    <td>
                        {{ $service->servname }}
                    </td>
                    <td>
                        {{ $service->description }}
                    </td>
                    <td>
                        {{ $service->price }}
                    </td>
                    <td>
                        <img src="{{ asset('uploads/services/' . $service->img_path) }}" alt="I am A Pic" width="100"
                            height="100">
                    </td>
                    @if ($service->deleted_at)
                        <td>
                            <a href="#">
                                <p>
                                    Update
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="service/{{ $service->id }}/edit">
                                Update
                            </a>
                        </td>
                    @endif
                    <td>
                        {!! Form::open(['route' => ['service.destroy', $service->id], 'method' => 'DELETE']) !!}
                        <button type="submit">
                            Delete
                        </button>
                        {!! Form::close() !!}
                    </td>
                    @if ($service->deleted_at)
                        <td>
                            <a href="{{ route('service.restore', $service->id) }}">
                                <p>
                                    Restore
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="#">
                                <p>
                                    Restore
                                </p>
                            </a>
                        </td>
                    @endif
                    <td>
                        <a href="{{ route('service.forceDelete', $service->id) }}">
                            <p onclick="return confirm('Do you want to delete this data permanently?')">
                                Destroy
                            </p>
                        </a>
                    </td>
                </tr>
            @empty
                <p>No Service Data in the Database</p>
            @endforelse
        </table>
        <div>{{ $services->links() }}</div>
    </div>
    </div>
@endsection
