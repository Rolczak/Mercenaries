<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <meta charset="utf-8">

    <title>Mercenaries</title>

</head>
<body>

<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark border-bottom border-secondary ">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse " id="nav-left">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">News</a></li>
                <li class="nav-item"><a href=#" class="nav-link">Rules</a></li>
            </ul>


        </div>
        <div class="align-self-center mx-auto">

            <a href="{{route('welcome')}}" class="navbar-brand mx-auto"><i
                        class="fa d-inline fa-lg fa-bomb "></i><b>Mercenaries</b></a>
        </div>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item"><a href="#" data-toggle="modal" data-target="#loginModal" class="btn navbar-btn btn-outline-light mr-1"><i class="fas fa-key"></i> Play Now</a></li>
            <li class="nav-item"><a href="#" data-toggle="modal" data-target="#registerModal" class="btn navbar-btn btn-outline-light"><i class="fas fa-clipboard-check"></i> Register Now</a></li>
        </ul>
        </div>
<!-- MOBILE -->
    <div class="collapse" id="navbarMobile">
        <div class="navbar-nav">
            <a href="#" class="nav-item nav-link">News</a>
            <a href="#" class="nav-item nav-link">Rules</a>
            <a href="#" data-toggle="modal" data-target="#loginModal" class="nav-item btn navbar-btn btn-outline-light"><i class="fas fa-key"></i> Play Now</a>
            <a href="#" data-toggle="modal" data-target="#registerModal" class="nav-item btn navbar-btn btn-outline-light"><i class="fas fa-clipboard-check"></i> Register Now</a>
        </div>
    </div>

</nav>

<div class="py-5 text-center cover d-flex flex-column bg-dark" style="color: white;">
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
    <div class="container mt-auto">
        <div class="row">
            <div class="mx-auto col-lg-6 col-md-8 col-10">
                <a href="#mission"><i class="d-block fa fa-angle-down fa-2x"></i></a>
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
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
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
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary" form="loginform">
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
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
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
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
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
                            <input id="password-confirm" type="password" class="form-control"
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
</body>

</html>

