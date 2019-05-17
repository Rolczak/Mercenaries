@extends('layouts.main')
@section('content')
    <div class="jumbotron">
        <h3>Arena</h3>
        <p class="lead">Here you can check your skill with other mercenaries.</p>
        <hr>
        <p>Cost: 5 action points
        <hr>
        <p>Time: 5 min</p>
        <hr>
        <p>Reward: Credits and Experience (depends on opponent level)</p>

        <hr class="my-4">

    <ul class="list-group">

        @foreach($users as $player)
            <li class="list-group-item">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item active"><a href="{{url('show/'.$player->id)}}">{{$player->name}}</a></li>
                    <li class="breadcrumb-item">Lvl: {{$player->value}}</li>
                    <form id="form{{$player->id}}" method="post" action="{{action('FightController@fightArena')}}">
                        @csrf
                        <input type="hidden"  name="val" value="{{$player->id}}">
                    </form>
                    <button form="form{{$player->id}}" class=" btn btn-primary ml-auto"><i class="fas fa-fist-raised  fa-2x"></i></button>
                </ol></li>

        @endforeach
    </ul>
    </div>
@stop


