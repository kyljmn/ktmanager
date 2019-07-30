<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>toDone @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    @yield('style')
  </head>
  <body>
    <div class="ui primary  menu">
            <a class="item" href="{{ url('/') }}">
                toDone
            </a>
            <a class="item" href="{{ url('/projects')}}">
              Projects
            </a>


            <div class="right menu">

                    <!-- Authentication Links -->
                    @guest

                            <a class="item" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))

                                <a class="item" href="{{ route('register') }}">{{ __('Register') }}</a>

                        @endif
                    @else
                            <a id="navbarDropdown" class="item" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                                <a class="item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                    @endguest
                  </div>
            </div>
            <div class="ui main container">
              @yield('content')
            </div>
            <script type="text/javascript">
            $('.ui.accordion').accordion();
            $('.ui.dropdown').dropdown();
            </script>
  </body>
</html>
