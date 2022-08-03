@extends('html.usermaster')
@section('title')
    Consultation Show
@endsection
@section('contents')
    <div>
        <div>
            <h1>
                Consultations
            </h1>
        </div>
        @forelse ($consultations as $consult)
            <section>
                <div>
                    <div>
                   
                     ID <p>{{$consult->id}}</p>
                     Employee Name <p>{{$consult->name}}</p>
                     Pet Name <p>{{$consult->petName}}</p>
                     Consultation Date <p>{{$consult->dateConsult}}</p>
                     Fees <p>{{$consult->fees}}</p>
                     Disease/Injury <p>{{$consult->title}}</p>
                     Vet comment <p>{{$consult->comment}}</p>

                    </div>
                </div>
            </section>
        @empty
            <p>No Consultation Data in the Database</p>
        @endforelse
        </table>
    </div>
@endsection