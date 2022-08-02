@extends('html.usermaster')
@section('title')
    Employee Show
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Show Employees
            </h1>
        </div>
        @forelse ($employees as $employee)
            <section>
                <div>
                    <img src="{{ asset('employee/images/' . $employee->img_path) }}" alt="I am A Pic" width="100"
                        height="100">
                    <div>
                        <h5>{{ $employee->servname }}
                        </h5>
                        User ID <p>{{ $employee->user_id }}</p>
                        ID <p>{{ $employee->id }}</p>
                        Name<p>{{ $employee->name }}</p>
                        Position<p>{{ $employee->position }}</p>
                        Address<p>{{ $employee->address }}</p>
                        Phone Number<p>{{ $employee->phonenumber }}</p>
                    </div>
                </div>
            </section>
        @empty
            <p>No employee Data in the Database</p>
        @endforelse
        </table>
    </div>
@endsection
