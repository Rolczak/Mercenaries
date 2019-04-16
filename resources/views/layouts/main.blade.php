<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Mercenaries</title>
    {{Auth::User()->calcEnergy()}}
</head>

<body>

<nav class="navbar  navbar-expand-lg navbar-dark bg-dark "  >
    <a href="#" data-target="#sidebar" data-toggle="collapse" aria-expanded="false"><i class="fa fa-navicon fa-2x py-2 p-1" style="color: gray"></i></a>
        <a class="navbar-brand pl-2" href="#">Mercenaries</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">

            <li><i class="fas fa-money-check-alt"></i><span class="navbar-item pr-1">Credits: {{Auth::User()->credits}}</span></li>
            <li><i style="color: #1eff2d" class="fas fa-radiation"></i><span class="navbar-item pr-1" style="color: #1eff2d">Uranium: {{Auth::User()->uranium}}</span></li>
            <li><i class="fas fa-bolt"></i> <span class="navbar-item pr-1"> Action Points: {{Auth::User()->actionpoints}}   <i class="far fa-clock"></i> Regen: <span id="timer"></span></span></li>

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
        <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width " id="sidebar">
            <div class="list-group border-0 card text-center text-md-left">
              <!--  <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i> <span class="d-none d-md-inline">Item 1</span> </a>
                <div class="collapse" id="menu1">
                    <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 1 </a>
                    <div class="collapse" id="menu1sub1">
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 1 a</a>
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 2 b</a>
                        <a href="#menu1sub1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 3 c </a>
                        <div class="collapse" id="menu1sub1sub1">
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.1</a>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.2</a>
                        </div>
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 4 d</a>
                        <a href="#menu1sub1sub2" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 5 e </a>
                        <div class="collapse" id="menu1sub1sub2">
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.1</a>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.2</a>
                        </div>
                    </div>
                    <a href="#" class="list-group-item" data-parent="#menu1">Subitem 2</a>
                    <a href="#" class="list-group-item" data-parent="#menu1">Subitem 3</a>
                </div>
                -->
                @if (Auth::User()->isAdmin())
                <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false" style="background-color: gold; color: black;"><i class="fas fa-star"></i> <span class="d-none d-md-inline">Admin Panel</span></a>
                    <div class="collapse" id="menu1">
                        <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Changelog</a>
                        <div class="collapse" id="menu1sub1">
                         <a href="{{url('admin/logs/create')}}" class="list-group-item" data-parent="#menu1sub1">Create</a>
                            <a href="{{url('admin/logs')}}" class="list-group-item" data-parent="#menu1sub1">Edit</a>
                            <!--  <a href="#menu1sub1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 3 c </a>
                           <div class="collapse" id="menu1sub1sub1">
                               <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.1</a>
                               <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.2</a>
                           </div>
                           <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 4 d</a>
                           <a href="#menu1sub1sub2" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 5 e </a>
                           <div class="collapse" id="menu1sub1sub2">
                               <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.1</a>
                               <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.2</a>
                           </div>-->
                       </div>
                       <a href="#" class="list-group-item" data-parent="#menu1">asd</a>
                       <a href="#" class="list-group-item" data-parent="#menu1">dsa</a>
                    </div>
                @endif
                <a href="{{url('/home')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
                <a href="{{url('/training')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-dumbbell"></i> <span class="d-none d-md-inline">Training</span></a>
                <a href="{{url('/work')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ruble-sign"></i> <span class="d-none d-md-inline">Work</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-file-signature"></i> <span class="d-none d-md-inline">Contracts</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-tasks"></i> <span class="d-none d-md-inline">Missions</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-gear"></i> <span class="d-none d-md-inline">Arena</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">One </span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">Day</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">Will be</span></a>
                <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-ellipsis-h"></i><span class="d-none d-md-inline">more</span></a>
            </div>
        </div>
        <main class="col-md-10 col px-5 pl-md-2 pt-2 main mx-auto">
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
</body>
</html>