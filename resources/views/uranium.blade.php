@extends('layouts.main')
@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Uranium Shop</h1>

        <p class="lead">Buy Uranium:</p>
        <hr class="my-4">
        <div class="row">
            <div class="card text-white bg-success mb-3 mx-auto my-3 " style="max-width: 20rem;">
                <img class="card-img-top bg-secondary" src="{{asset('img/misc/ore.png')}}">

                <div class="card-body">
                    <h5 class="card-title">Uranium Ore</h5>
                    <hr>
                    <p class="card-text">Small amount of uranium, but it can help pass hard times.</p>
                    <p class="card-title">Cost: 10zł</p>
                    <p class="card-title">Contains: <b>15 Uranium</b></p>
                </div>

                <div class="card-body text-center">
                    <form id="ur1" method="post" action="{{action('UraniumController@addUranium',['val'=>15])}}">@csrf</form>
                    <button form="ur1" class="btn btn-light">Buy</button>
                </div>
            </div>

            <div class="card text-white bg-success mb-3 mx-auto my-3 " style="max-width: 20rem;">
                <img class="card-img-top bg-secondary" src="{{asset('img/misc/barrel.png')}}">

                <div class="card-body">
                    <h5 class="card-title">Uranium Barrel</h5>
                    <hr>
                    <p class="card-text">You don't like waiting. Didn't you?</p>
                    <p class="card-title">Cost: 20zł</p>
                    <p class="card-title">Contains: <b>50 Uranium</b></p>
                </div>

                <div class="card-body text-center">
                    <form id="ur2" method="post" action="{{action('UraniumController@addUranium',['val'=>50])}}">@csrf</form>
                    <button form="ur2" class="btn btn-light">Buy</button>
                </div>
            </div>

            <div class="card text-white bg-success mb-3 mx-auto my-3 " style="max-width: 20rem;">
                <img class="card-img-top bg-secondary" src="{{asset('img/misc/tank.png')}}">

                <div class="card-body">
                    <h5 class="card-title">Uranium Tank</h5>
                    <hr>
                    <p class="card-text">Jurij Owsienko will be proud of you. You can have everything with this amount of uranium. Spend it well!</p>
                    <p class="card-title">Cost: 100zł</p>
                    <p class="card-title">Contains: <b>300 Uranium</b></p>
                </div>

                <div class="card-body text-center">
                    <form id="ur3" method="post" action="{{action('UraniumController@addUranium',['val'=>300])}}">@csrf</form>
                    <button form="ur3" class="btn btn-light">Buy</button>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <p class="lead">Spend Uranium:</p>
        <hr class="my-4">
        <div class="row">
            <div class="card text-white bg-success mb-3 mx-auto my-3 " style="max-width: 20rem;">
                <img class="card-img-top bg-secondary" src="{{asset('img/misc/needle.png')}}">

                <div class="card-body">
                    <h5 class="card-title">Regenerate Health</h5>
                    <hr>
                    <p class="card-text">10 hp for hour is not enough? Inject some uranium</p>
                    <p class="card-title">Cost: 5 Uranium</p>
                </div>

                <div class="card-body text-center">
                    <form id="haps" method="post" action="{{action('UraniumController@regenHealth',['val'=>5])}}">@csrf</form>
                    <button form="haps" class="btn btn-light">Buy</button>
                </div>
            </div>

            <div class="card text-white bg-success mb-3 mx-auto my-3 " style="max-width: 20rem;">
                <img class="card-img-top bg-secondary" src="{{asset('img/misc/shoot.png')}}">

                <div class="card-body">
                    <h5 class="card-title">Regenerate Action Points</h5>
                    <hr>
                    <p class="card-text">You look so tired. What did you say to small uranium shot?</p>
                    <p>Cost: 5 Uranium</p>
                </div>

                <div class="card-body text-center">
                    <form id="enr" method="post" action="{{action('UraniumController@regenAction',['val'=>5])}}">@csrf</form>
                    <button form="enr" class="btn btn-light">Buy</button>
                </div>
            </div>
        </div>

    </div>
@stop
