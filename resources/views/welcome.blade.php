<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mercenaries</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}" defer></script>

    <meta charset="utf-8">

    <title>Mercenaries</title>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary ">
        <a class="navbar-brand" href="{{route('welcome')}}">Mercenaries</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCol"
                aria-controls="navbarCol" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCol">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="#" class="nav-link">News</a></li>
                <li class="nav-item"><a href=#" class="nav-link">Rules</a></li>
            </ul>
            <ul class="navbar-nav  my-2 my-lg-0">
                <li class="nav-item"><a href="#" data-toggle="modal" data-target="#loginModal"
                                        class="btn navbar-btn btn-light mr-1"><i class="fas fa-key"></i> Play Now</a>
                </li>
                <li class="nav-item"><a href="#" data-toggle="modal" data-target="#registerModal"
                                        class="btn navbar-btn btn-light"><i class="fas fa-clipboard-check"></i> Register
                        Now</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="py-5 text-center cover d-flex flex-column">
        <div class="container">
            <div class="row" draggable="true">
                <div class="mx-auto col-lg-6 col-md-8 col-xs-12">
                    <h1 class="h1 text-center py-5">Mercenaries</h1>
                    <h3 class="mb-4"><b>Cross Platform Browser Game</b></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et
                        dolore magna aliqua.&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="1" role="dialog" aria-labelledby="loginModalLabelladby" id="loginModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModalLabel">Sin in to continue your journey</h4>
                <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--Login form--}}
                <form method="POST" action="{{ route('login') }}" id="loginform">
                    @csrf
                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="emailL" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email"
                                   value="{{ old('email') }}" required autofocus>
                            <label class="alert alert-danger " style="display: none" id="elErrMsg"></label>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="passwordL" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer">
                <div class="form-group row mb-0">
                    <button type="submit" class="btn btn-primary" form="loginform" id="loginButton">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="1" role="dialog" aria-labelledby="registerModalLabelladby" id="registerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModalLabel">Sin in to start your journey</h4>
                <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--Register form--}}
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="emailR" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="passwordR" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="passwordR-confirm" type="password" class="form-control"
                            <input id="passwordRem-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer">
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" form="registerForm">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="alert text-center cookiealert fixed-bottom" role="alert">
    <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website.
    <a
            href="https://cookiesandyou.com/" target="_blank">Learn more</a>

    <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
        I agree
    </button>
</div>
<script src="{{ asset('js/app.js')}}"></script>
<script>
    /*
 * Bootstrap Cookie Alert by Wruczek
 * https://github.com/Wruczek/Bootstrap-Cookie-Alert
 * Released under MIT license
 */
    (function () {
        "use strict";

        var cookieAlert = document.querySelector(".cookiealert");
        var acceptCookies = document.querySelector(".acceptcookies");

        if (!cookieAlert) {
            return;
        }

        cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

        // Show the alert if we cant find the "acceptCookies" cookie
        if (!getCookie("acceptCookies")) {
            cookieAlert.classList.add("show");
        }

        // When clicking on the agree button, create a 1 year
        // cookie to remember user's choice and close the banner
        acceptCookies.addEventListener("click", function () {
            setCookie("acceptCookies", true, 365);
            cookieAlert.classList.remove("show");
        });

        // Cookie functions from w3schools
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    })();
</script>
</body>

</html>

