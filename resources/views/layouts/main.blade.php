<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield('head')
    <title>Mercenaries</title>

    {{Auth::User()->calcEnergy()}}
    {{Auth::User()->calcHealth()}}
    {{Auth::User()->checkLvlUp()}}

    <?php
    $last_id = auth()->user()->quests->last();
    if ($last_id != null) {
        $last_id = $last_id->id;
    } else {
        $last_id = 0;
    }
    ?>
</head>

<body>
<div id="app">

    <nav class="navbar  navbar-expand-lg navbar-dark bg-primary sticky-top ">
        <a href="#" data-target="#sidebar" data-toggle="collapse" aria-expanded="false"><i
                    class="fa fa-navicon fa-2x py-2 p-1" style="color: white;"></i></a>
        <a class="navbar-brand ml-2" href="{{route('home')}}">Mercenaries</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto breadcrumb my-auto mx-auto">

                <li class="breadcrumb-item"><i class="fas fa-money-check-alt"></i><span
                            class="navbar-item pr-1">Credits: {{Auth::User()->credits}}</span></li>
                <li class="breadcrumb-item"><a href="{{route('shop')}}"><i style="color: #1eff2d"
                                                                           class="fas fa-radiation"></i><span
                                class="navbar-item pr-1"
                                style="color: #1eff2d">Uranium: {{Auth::User()->uranium}}</span></a></li>
                <li class="breadcrumb-item"><i class="fas fa-bolt"></i> <span class="navbar-item pr-1"> Action Points: {{Auth::User()->action_points}}   <i
                                class="far fa-clock"></i> Regen: <span id="timer"></span></span></li>
                <li class="breadcrumb-item"><i class="fas fa-book"></i><span
                            class="navbar-item pr-1"> Lvl:  {{Auth::User()->getStat('level')}} {{Auth::User()->getStat('experience')}}/{{Auth::User()->expToNext()}}</span>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="notifyDropdown" href="#" class="nav-link text-white" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-bell  align-middle"></i>
                        @if(auth()->user()->unreadNotifications->count() != 0)
                            <span class="ml-1 badge badge-danger  align-middle">{{auth()->user()->notifications->count()}}</span> @endif
                    </a>
                    @if(auth()->user()->unreadNotifications->count() != 0)
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notifyDropdown">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li class="dropdown-item"><a href="{{route('read', [$notification->id])}}"
                                                             class="nav-link">{{$notification->data['data']}}</a></li>
                            @endforeach
                        </ul>
                    @endif

                </li>
                <li class="nav-item dropdown mr-2">
                    <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item  {{$last_id < 1 ? 'disabled' :'' }}"
                           href="{{url('/show/'.Auth::User()->id)}}">Statistics</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row d-flex d-md-block flex-nowrap wrapper">
            <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width position-fixed " id="sidebar">
                <div class="list-group border-0 card text-center text-md-left">
                    @if (Auth::User()->isAdmin())
                        <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                           data-parent="#sidebar" aria-expanded="false" style="background-color: gold; color: black;"><i
                                    class="fas fa-star"></i> <span class="d-none d-md-inline">Admin Panel</span></a>
                        <div class="collapse" id="menu1">
                            <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Changelog</a>
                            <div class="collapse" id="menu1sub1">
                                <a href="{{url('admin/logs/create')}}" class="list-group-item" data-parent="#menu1sub1">Create</a>
                                <a href="{{url('admin/logs')}}" class="list-group-item"
                                   data-parent="#menu1sub1">Edit</a>
                            </div>
                            <a href="#menu1sub2" class="list-group-item" data-toggle="collapse"
                               aria-expanded="false">Items</a>
                            <div class="collapse" id="menu1sub2">
                                <a href="{{url('admin/items/create')}}" class="list-group-item"
                                   data-parent="#menu1sub1">Create</a>
                                <a href="{{url('admin/items')}}" class="list-group-item"
                                   data-parent="#menu1sub1">Edit</a>
                            </div>
                            <a href="{{url('admin/bans/create')}}" class="list-group-item"
                               data-parent="#menu">Ban</a>
                            <a href="{{url('admin/bans')}}" class="list-group-item"
                               data-parent="#menu">Ban List</a>
                        </div>
                    @endif
                    <a href="{{route('home')}}" class="collapsed btn text-left btn-light" data-parent="#sidebar"><i
                                class="fas fa-home"></i> <span class="d-none d-md-inline">Home</span></a>

                    <a href="{{route('quests')}}" class="collapsed btn text-left btn-light" data-parent="#sidebar"><i
                                class="fas fa-question"></i><span class="d-none d-md-inline">Quests</span></a>

                    <a href="{{route('training')}}"
                       class="collapsed btn text-left btn btn-light  {{$last_id < 3 ? 'disabled' :'' }}"
                       data-parent="#sidebar"><i
                                class="fas fa-dumbbell"></i> <span class="d-none d-md-inline">Training</span></a>

                    <a href="{{route('work')}}"
                       class="collapsed btn text-left btn-light {{$last_id < 3 ? 'disabled' :'' }}"
                       data-parent="#sidebar"><i
                                class="fas fa-ruble-sign"></i> <span class="d-none d-md-inline">Work</span></a>

                    <a href="{{route('contracts')}}"
                       class="collapsed text-left btn btn-light {{$last_id < 4 ? 'disabled' :'' }}"
                       data-parent="#sidebar"><i
                                class="fas fa-file-signature"></i> <span class="d-none d-md-inline">Contracts</span></a>

                    <a href="{{route('ItemShop')}}"
                       class="collapsed btn text-left btn-light {{$last_id < 4 ? 'disabled' :'' }}"
                       data-parent="#sidebar"><i
                                class="fas fa-wallet"></i><span class="d-none d-md-inline">Shop</span></a>

                    <a href="{{route('arena')}}"
                       class="collapsed btn text-left btn-light {{$last_id < 4 ? 'disabled' :'' }}"
                       data-parent="#sidebar"><i
                                class="fa fa-gear"></i> <span class="d-none d-md-inline">Arena</span></a>


                </div>
            </div>
        </div>

        @if(Session::has('err'))
            <div class="modal fade" id="errModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if(Session::has('errTitle'))
                                    {{Session::get('errTitle')}}
                                @else
                                    An Error Occurred During Action
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-warning">
                            {{Session::get('err')}}
                        </div>
                    </div>
                </div>
            </div>


        @elseif(Session::has('mod'))
            <div class="modal fade" id="dialModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if(Session::has('modTitle'))
                                    {{Session::get('modTitle')}}
                                @else
                                    Information
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-success">
                            {{Session::get('mod')}}
                        </div>
                    </div>
                </div>
            </div>

        @elseif(Session::has('micro'))
            <div class="modal fade" id="microModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if(Session::has('microTitle'))
                                    {{Session::get('microTitle')}}
                                @else
                                    Uranium Shop
                                @endif
                            </h5>
                            <button type="button" style="color: white;" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-white">
                            {{Session::get('micro')}} {{Session::get('microVal')}}<i style="color: #1eff2d;"
                                                                                     class="fas fa-radiation"></i>
                        </div>
                        <div class="modal-footer">
                            <form action="{{action('UraniumController@speedUpRest')}}" id="mic" method="post">
                                @csrf
                                <input type="hidden" name="val" value="{{Session::get('microVal')}}">
                            </form>
                            <button class="btn-primary btn" form="mic">Pay {{Session::get('microVal')}} <i
                                        style="color: #1eff2d;" class="fas fa-radiation"></i></button>

                        </div>
                    </div>

                </div>
            </div>

        @endif
        @yield('modals')

        <main class="col-md-10 col px-5 pl-md-2 pt-2 main mx-auto" data-aos="fade-up">

            @yield('content')

        </main>
        <div class="alert text-center cookiealert fixed-bottom" role="alert">
            <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website.
            <a
                    href="https://cookiesandyou.com/" target="_blank">Learn more</a>

            <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
                I agree
            </button>
        </div>
    </div>
</div>


<script>

    if ("{{Auth::User()->calcTimeForJS()}}" == "") {
        document.getElementById("timer").innerHTML = "-";
    } else {
        var countDownDate = new Date("{{Auth::User()->calcTimeForJS()}}");
        var x = setInterval(function () {
            var now = new Date().getTime();
            var dist = countDownDate - now;
            var minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((dist % (1000 * 60)) / (1000));
            document.getElementById("timer").innerHTML = minutes + 'm ' + seconds + 's';

            if (dist < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "New point added";
            }
        }, 1000);
    }
</script>



<script src="{{ asset('js/app.js')}}"></script>
@yield('scripts')
<script>
    (function ($) {
        window.onbeforeunload = function (e) {
            window.name += ' [' + $(window).scrollTop().toString() + '[' + $(window).scrollLeft().toString();
        };
        $.maintainscroll = function () {
            if (window.name.indexOf('[') > 0) {
                var parts = window.name.split('[');
                window.name = $.trim(parts[0]);
                window.scrollTo(parseInt(parts[parts.length - 1]), parseInt(parts[parts.length - 2]));
            }
        };
        $.maintainscroll();
    })(jQuery);
</script>
@if(Session::has('err'))
    <script type="text/javascript">
        $(document).ready(function () {

            $("#errModal").modal('show');

        });
    </script>
@elseif(Session::has('mod'))
    <script type="text/javascript">
        $(document).ready(function () {

            $("#dialModal").modal('show');

        });
    </script>
@elseif(Session::has('micro'))
    <script type="text/javascript">
        $(document).ready(function () {

            $("#microModal").modal('show');

        });
    </script>
@endif
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