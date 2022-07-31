@extends('html.usermaster')
@section('title')
    Service Show
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Show Services
            </h1>
        </div>
        @forelse ($services as $service)
            <section>
                <div>
                    <img src="{{ asset('service/images/' . $service->img_path) }}" alt="I am A Pic" width="100"
                        height="100">
                    <div>
                        <h5>{{ $service->servname }}
                        </h5>
                        Description<p>{{ $service->description }}</p>
                        ID<p>{{ $service->id }}</p>
                        Price<p>{{ $service->price }}</p>
                    </div>
                </div>
            </section>
        @empty
            <p>No Service Data in the Database</p>
        @endforelse
        </table>
    </div>
@endsection
