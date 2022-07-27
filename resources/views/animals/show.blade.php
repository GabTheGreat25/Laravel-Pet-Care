
    @extends('html.master')
    @section('title')
        Animal Show
    @endsection
    @section('contents')
        <div>
            <div>
                <h1>
                    Show animals
                </h1>
            </div>
            @forelse ($animals as $animal)
                <section>
                    <div>
                        <img src="{{ asset('images/animals/' . $animal->img_path) }}" alt="I am A Pic" width="100"
                            height="100">
                        <div>
                            <h5>{{ $animal->servname }}</h5>
                            Animal ID <p>{{ $animal->id }}</p>
                            ID <p>{{ $animal->petName}}</p>
                            Pet Owner<p>{{ $animal->firstName }}</p>
                            Title<p>{{ $animal->Age }}</p>
                            First Name<p>{{ $animal->Type }}</p>
                            Last Name<p>{{ $animal->Breed }}</p>
                            Age<p>{{ $animal->Sex }}</p>
                            Address<p>{{ $animal->Color }}</p>
                        </div>
                    </div>
                </section>
            @empty
                <p>No animal Data in the Database</p>
            @endforelse
            </table>
        </div>
    @endsection
    