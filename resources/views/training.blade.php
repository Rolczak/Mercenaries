@extends('layouts.main')
@section('content')
    <h3>Here you can train your skills to be better</h3>
    <div class="row">
        <div class="card" style="width: 18rem;">
            <i class="fas fa-heart card-img-top"></i>

            <div class="card-body">
                <h5 class="card-title">Strength</h5>
                <p class="card-text">Strength increase Your maximum amount of health points... </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->strength}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->strength}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(1)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="str" method="post" action="{{action('HomeController@train',['stat'=>1])}}">@csrf</form>
                <button form="str" class="btn-dark">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>
        </div>

        <div class="card" style="width: 18rem;">
            <i class="fas fa-crosshairs card-img-top"></i>

            <div class="card-body">
                <h5 class="card-title">Accuraccy</h5>
                <p class="card-text">Accuracy increase your chances to shoot enemy </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->accuracy}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->accuracy}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(2)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="acc" method="post" action="{{action('HomeController@train',['stat'=>2])}}">@csrf</form>
                <button form="acc" class="btn-dark">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>
        </div>

        <div class="card" style="width: 18rem;">
            <i class="fas fa-coins card-img-top"></i>

            <div class="card-body">
                <h5 class="card-title">Bargaining</h5>
                <p class="card-text">Bargaining increase your income from missions </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Base: {{Auth::User()->accuracy}}</li>
                <li class="list-group-item">Sum: {{Auth::User()->accuracy}} </li>
                <li class="list-group-item">Upgrade Cost: {{Auth::User()->calcTrainingCost(3)}} </li>
            </ul>
            <div class="card-body text-center">
                <form id="bar" method="post" action="{{action('HomeController@train',['stat'=>3])}}">@csrf</form>
                <button form="bar" class="btn-dark">Train &nbsp;<i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
@stop