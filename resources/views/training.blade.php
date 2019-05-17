@extends('layouts.main')
@section('content')
    <div class="jumbotron">
    <h1 class="display-3">Training</h1>

        <p class="lead">Training is very important if you want to be good mercenary. Go to gym and gain some muscle, train on shooting range or get bargaining lessons from best instructors. </p>
        <hr class="my-4">
    <div class=" row">

        <div class="card text-white bg-primary mb-3 mx-auto my-3 " style="max-width: 20rem;" >
            <img class="card-img-top" src="{{asset('img/training/strength.png')}}">

            <div class="card-body">
                <h5 class="card-title">Strength</h5>
                <p class="card-text">Strength increase Your maximum amount of health points. </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->getStat('strength')}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->calcStat('strength')}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(1)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="str" method="post" action="{{action('HomeController@train',['stat'=>1])}}">@csrf</form>
                <button form="str" class="btn btn-secondary">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>
        </div>

        <div class="card text-white bg-primary mb-3 mx-auto my-3" style="width: 20rem;">
            <img class="card-img-top" src="{{asset('img/training/accuracy.png')}}">

            <div class="card-body">
                <h5 class="card-title">Accuraccy</h5>
                <p class="card-text">Accuracy increase your chances to shoot enemy </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->getStat('accuracy')}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->calcStat('accuracy')}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(2)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="acc" method="post" action="{{action('HomeController@train',['stat'=>2])}}">@csrf</form>
                <button form="acc" class="btn btn-secondary">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>
        </div>

        <div class="card text-white bg-primary mb-3 mx-auto my-3" style="width: 20rem;">
            <img class="card-img-top" src="{{asset('img/training/bargaining.png')}}">

            <div class="card-body">
                <h5 class="card-title">Bargaining</h5>
                <p class="card-text">Bargaining increase your income from missions </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->getStat('bargaining')}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->calcStat('bargaining')}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(3)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="bar" method="post" action="{{action('HomeController@train',['stat'=>3])}}">@csrf</form>
                <button form="bar" class="btn btn-secondary">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>

        </div>
    </div>
    </div>
@stop