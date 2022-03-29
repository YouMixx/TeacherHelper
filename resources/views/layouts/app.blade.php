<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="d-flex flex-wrap justify-content-center py-2 mb-4 border-bottom bg-black p-4 unselectable">
            <div class="row justify-content-between align-items-center w-100">
                <div class="col-xl-4 col-4 pt-1">
                    <a href="/" class="d-flex align-items-center mb-md-0 me-md-auto text-decoration-none text-white">
                        <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                @if(Route::current()->getName() == 'show_books')
                <div class="col-xl-4 col-12 order-xl-2 order-3">
                    <div class="language-switch d-flex justify-content-center align-items-center" >
                        <span id="first">ENGLISH</span>
                        <img src="{{URL::asset('/images/swap.png')}}" alt="" class="mx-3">
                        <span id="second">RUSSIAN</span>
                    </div>
                </div>
                @endif
                <div class="col-xl-4 col-8 order-2 d-flex justify-content-end align-items-center">
                    <a href="{{ url('wordbooks') }}" class="nav-link">Выбрать словарь</a>
                    <a href="{{ url('load') }}" class="nav-link">Загрузить словарь</a>
                </div>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
