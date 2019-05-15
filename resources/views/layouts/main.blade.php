<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Mercenaries</title>
    {{Auth::User()->calcEnergy()}}
    {{Auth::User()->calcHealth()}}
    {{Auth::User()->checkLvlUp()}}
</head>

<body>

<nav class="navbar  navbar-expand-lg navbar-dark bg-dark sticky-top "  >
    <a href="#" data-target="#sidebar" data-toggle="collapse" aria-expanded="false"><i class="fa fa-navicon fa-2x py-2 p-1" style="color: gray"></i></a>
        <a class="navbar-brand pl-2" href="#">Mercenaries</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto ">

            <li><i class="fas fa-money-check-alt"></i><span class="navbar-item pr-1">Credits: {{Auth::User()->credits}}</span></li>
            <li><i style="color: #1eff2d" class="fas fa-radiation"></i><span class="navbar-item pr-1" style="color: #1eff2d">Uranium: {{Auth::User()->uranium}}</span></li>
            <li><i class="fas fa-bolt"></i> <span class="navbar-item pr-1"> Action Points: {{Auth::User()->action_points}}   <i class="far fa-clock"></i> Regen: <span id="timer"></span></span></li>
            <li><i class="fas fa-book"></i><span class="navbar-item pr-1"> Lvl:  {{Auth::User()->getStat('level')}} {{Auth::User()->getStat('experience')}}/{{Auth::User()->expToNext()}}</span></li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{url('/show/'.Auth::User()->id)}}">Statistics</a>

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
                <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false" style="background-color: gold; color: black;"><i class="fas fa-star"></i> <span class="d-none d-md-inline">Admin Panel</span></a>
                    <div class="collapse" id="menu1">
                        <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Changelog</a>
                        <div class="collapse" id="menu1sub1">
                         <a href="{{url('admin/logs/create')}}" class="list-group-item" data-parent="#menu1sub1">Create</a>
                            <a href="{{url('admin/logs')}}" class="list-group-item" data-parent="#menu1sub1">Edit</a>
                       </div>
                        <a href="#menu1sub2" class="list-group-item" data-toggle="collapse" aria-expanded="false">Items</a>
                        <div class="collapse" id="menu1sub2">
                            <a href="{{url('admin/items/create')}}" class="list-group-item" data-parent="#menu1sub1">Create</a>
                            <a href="{{url('admin/items')}}" class="list-group-item" data-parent="#menu1sub1">Edit</a>
                        </div>
                       <a href="#" class="list-group-item" data-parent="#menu1">asd</a>
                       <a href="#" class="list-group-item" data-parent="#menu1">dsa</a>
                    </div>
                @endif
                <a href="{{route('home')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
                <a href="{{route('training')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-dumbbell"></i> <span class="d-none d-md-inline">Training</span></a>
                <a href="{{route('work')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ruble-sign"></i> <span class="d-none d-md-inline">Work</span></a>
                <a href="{{route('contracts')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-file-signature"></i> <span class="d-none d-md-inline">Contracts</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-tasks"></i> <span class="d-none d-md-inline">Missions</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-gear"></i> <span class="d-none d-md-inline">Arena</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">One </span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">Day</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">Will be</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">more</span></a>
            </div>
        </div>
        <main class="col-md-10 col px-5 pl-md-2 pt-2 main mx-auto">
            @if(Session::has('err'))
                <div class="modal fade" id="errModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    @if(Session::has('errTitle'))
                                        {{Session::get('errTitle')}}
                                    @else
                                        An Error Occurred During Action</h5>
                                    @endif
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-danger">
                                {{Session::get('err')}}
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){

                        $("#errModal").modal('show');

                    });
                </script>

            @elseif(Session::has('mod'))
                <div class="modal fade" id="dialModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    @if(Session::has('modTitle'))
                                        {{Session::get('modTitle')}}
                                    @else
                                        Information</h5>
                                    @endif
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{Session::get('mod')}}
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){

                        $("#dialModal").modal('show');

                    });
                </script>
            @elseif(Session::has('micro'))
                <div class="modal fade" id="microModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark rounded text-white">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    @if(Session::has('microTitle'))
                                        {{Session::get('microTitle')}}
                                    @else
                                        Uranium Shop</h5>
                                @endif
                                <button type="button"  style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               {{Session::get('micro')}} {{Session::get('microVal')}}<i style="color: #1eff2d;" class="fas fa-radiation"></i>
                            </div>
                                <div class="modal-footer">
                                    <form action="{{action('UraniumController@speedUpRest')}}" id="mic" method="post">
                                        @csrf
                                        <input type="hidden" name="val" value="{{Session::get('microVal')}}">
                                    </form>
                                        <button class="btn-secondary btn" form="mic">Pay {{Session::get('microVal')}} <i style="color: #1eff2d;" class="fas fa-radiation"></i></button>

                                </div>
                        </div>

                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){

                        $("#microModal").modal('show');

                    });
                </script>

            @endif
          @yield('content')
        </main>
    </div>
</div>




<script>

    if("{{Auth::User()->calcTimeForJS()}}"=="")
    {
        document.getElementById("timer").innerHTML = "-";
    }
    else {
    var countDownDate = new Date("{{Auth::User()->calcTimeForJS()}}");
    var x = setInterval(function() {
        var now = new Date().getTime();
        var dist = countDownDate- now;
        var minutes =  Math.floor((dist%(1000*60*60))/(1000*60));
        var seconds =  Math.floor((dist%(1000*60))/(1000));
        document.getElementById("timer").innerHTML = minutes + 'm ' + seconds + 's';

        if(dist <0){
            clearInterval(x);
            document.getElementById("timer").innerHTML = "New point added";
        }
    },1000);
    }
</script>

@yield('scripts')
</body>
</html>