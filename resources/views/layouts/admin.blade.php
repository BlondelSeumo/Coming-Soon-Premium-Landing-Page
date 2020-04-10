<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Coming-Soon</title>

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">


        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            @if (!Auth::guest())
                                <li>
                                    <a href="{{ url('/admin')}}"> 
                                        <i class="fa fa-user-circle"> </i> 
                                        Admin Home 
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            @if (!Auth::guest())
                                <li>
                                    <a href="{{ url('admin/subscriptions')}}">
                                        <i class="fa fa-list"></i>
                                        Subscriber List
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>        
            </nav>
        <div class="container">
                @if (count($errors) > 0)
                    <div style="text-align: center;" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </ul>
                    </div>
                @endif

            @yield('content')
        
        </div>

    </body>
</html>
