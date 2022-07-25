<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            main {
  width: 100%;
  max-width: 720px;
  padding: 2rem;
  margin: 0 auto;
}

.toggle-el {
  padding: 2rem;
  height: 240px;
  background: white;
  transition: all 0.2s ease;
  opacity: 1;
  margin-top: 1rem;
  overflow: hidden;
}

input[type=checkbox].hide-input:checked + .toggle-el {
  height: 0;
  opacity: 0;
  padding-top: 0;
  padding-bottom: 0;
}

input.hide-input {
  position: absolute;
  left: -999em;
}

label.toggle {
  text-align: center;
  display: inline-block;
  cursor: pointer;
  padding: 0.5em 1em;
  font-size: 1rem;
  color: #242424;
  background: #b5b5b5;
  border-radius: 3px;
  user-select: none;
}
        </style>
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS -->
          <!-- change link nalang -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">
        @yield('styles')
    </head>
    <body style="background-image: url(bg.png); background-size:cover;">
       
        {{-- @include('partials.header') --}}
        <div class="container">
            @yield('content')
        </div>
        <script src="https://cdnjs.cloudflare.com/.../Chart.js/2.9.3/Chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        @yield('scripts')
        </body>
    </html>