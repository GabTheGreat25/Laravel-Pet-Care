<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <!-- change link nalang -->
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        main {
            height: 100%;
            width: 100%;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.5)),
                url(homepagebg.png);
            background-size: cover;
            background-repeat: no-repeat;
            display: grid;
            grid-template-rows: 5rem auto;
        }

        .text-container {
            display: grid;
            justify-items: center;
            align-items: center;
            text-align: justify;
            padding: 0 10rem;
            color: rgb(255, 255, 255);
        }

        .text-title {
            font-weight: 700;
            padding-bottom: .5rem;
        }

        .text-content {
            font-weight: 700;
            font-size: 2.5rem;
            text-align: center;
        }

        .text-ul {
            font-weight: 700;
            font-size: 2rem;
            text-align: justify;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('src/css/app.css') }}">
    @yield('styles')
</head>
<main>
    <div class="test">
        <div>
            @include('partials.header')
            <div class="text-container">
                <h1 class="text-title">Our Vision and Goals</h1>
                <p class="text-content">Our mission is to provide, with care and compassion, veterinary services of the
                    highest standard for
                    our patients through every stage of their life.

                    We feel that the animal-human bond is crucial to human health and happiness, so we strive to ensure
                    that we look after the welfare of the animal within this bond to the very best of our ability.

                    We have high expectations of ourselves, so we aim to do the very best for you and your animals.</p>

                <h1 class="text-title">The Philosophies that guide us</h1>
                <p class="text-content">We aim to ensure that each animal under our care achieves its maximum life span
                    whilst remaining in the best of health without suffering or experiencing pain throughout that time.
                    We believe that the quality of an animal’s life is the utmost important in ensuring their happiness
                    throughout all stages of life.</p>

                <h1 class="text-title">We do this by …</h1>
                <div class="text-ul">
                    <ul> - Offering the best of treatment options, and allowing clients to make an informed decision by
                        which
                        we will abide.</ul>
                    <ul> - Handling all cases individually, with empathy and understanding.</ul>
                    <ul> - Being an advocate for prevention of disease and suffering in all animals.</ul>
                    <ul> - Pride in our workmanship … “Doing it once, and doing it right the first time”.</ul>
                    <ul> - We believe fully in educating our clients in responsible pet ownership, especially children.
                    </ul>
                    <ul> - All of our staff are required to attend continuing education seminars and workshops to keep
                        their
                        knowledge and skills modern and up to date..</ul>
                </div>
            </div>
        </div>

    </div>
    <div>
        @yield('content')
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/.../Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    @yield('scripts')
</main>

</html>
