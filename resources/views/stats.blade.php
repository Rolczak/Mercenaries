@extends('layouts.main')
@section('content')
<?php
        $user = \App\User::findOrFail($id);
?>
<div>
    <h3>{{$user->name}}</h3>
    <ul class="list-group">
        <li class="list-group-item">Healt Point: {{$user->hp}}</li>
        <li class="list-group-item">Strength: {{$user->strength}}  + {{$user->calcItemBonus(1)}} = {{$user->calcOverallStat(1)}}</li>
        <li class="list-group-item">Accuracy: {{$user->accuracy}} + {{$user->calcItemBonus(2)}} = {{$user->calcOverallStat(2)}}</li>
        <li class="list-group-item">Bargaining: {{$user->bargaining}} + {{$user->calcItemBonus(3)}} = {{$user->calcOverallStat(3)}}</li>
    </ul>
</div>
<h3>Weapon: </h3>
@if($user->getEquippedWeapon())
    {{$user->getEquippedWeapon()->name}}
@else
    None
@endif
<h3>Armour: </h3>
@if($user->getEquippedArmour())
    {{$user->getEquippedArmour()->name}}
@else
    None
@endif


    @if($id == Auth::User()->id)
      <h2>Ekwipunek</h2>
        @foreach(Auth::User()->getAllItems() as $item)
            {{$item->name}}
        @endforeach
    @endif
@stop