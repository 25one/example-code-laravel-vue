<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Styles CSS -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- awesome css -->  
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">  
    <!-- main.css (template) -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- app css (laravel) -->    
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- mix -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('css/vue2-datepicker/index.css') }}">

    <link rel="stylesheet" href="{{ asset('css/vue-toast/theme-sugar.css') }}">

    @yield('css')

</head>
<body>
<div class="row">
    <div class="col-md-3">
        <div class="add_funct_top">
          <a class="btn btn-link btn-xs btn-block page_content" href="#" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><div class="dropdown-menu-div">Logout {{$user['name']}}</div></a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
    </div>
</div>
    <div id="app">
       @yield('main')
    </div>
<!-- Scripts JS -->   
<!-- app js (laravel) -->
<script src="{{ mix('js/app.js') }}"></script> <!-- mix -->

@yield('js') 

</body>
</html>
