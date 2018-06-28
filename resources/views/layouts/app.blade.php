<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @section('head')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TreeView</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @show
    </head>
    <body role="document">
        <nav class="navbar navbar-expand-lg navbar-light navbar-inverse navbar-static-top" style="background-color: #e3f2fd;" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item" {{ (Request::is('workers') ? 'class=active' : '') }}>
                            <a class="nav-link" href="{{ route('workersTree') }}">Дерево сотрудников</a>
                        </li>
                        @if (Auth::guest())
                        <li class="nav-item" {{ (Request::is('login') ? 'class=active' : '') }}>
                            <a class="nav-link" href="{{ route('login') }}">Вход</a>
                        </li>
                        <li class="nav-item" {{ (Request::is('register') ? 'class=active' : '') }}>
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                        @else
                        <li class="nav-item" {{ (Request::is('admin/*') ? 'class=active' : '') }}>
                            <a class="nav-link"  href="{{ route('listWorkers') }}">Редактировать</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Выход
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        @section('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        @show
    </body>
</html>