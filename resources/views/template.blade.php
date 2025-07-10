<?php
session_start();
?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bit" />
        <meta name="author" content="" />
        <title>Bit2 @yield('title')</title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="{{asset('css/template.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @stack('css')
       
    </head>

@auth
<body class="sb-nav-fixed">

    <x-navegation-header></x-navegation-header>
    
            <div id="layoutSidenav">
                <x-navegation-menu></x-navegation-menu>
                
                <div id="layoutSidenav_content">
                    <main>
                        @yield('content')
                       
                    </main>
    <x-footer></x-footer>
                </div>
            </div>
            @stack('js')
             
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="{{asset('js/scripts.js')}}"></script>
       {{--     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
            <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="{{asset('js/datatables-simple-demo.js')}}"></script> --}}
        </body>
@endauth
@guest
     @include('pages.401')
@endguest

</html>
