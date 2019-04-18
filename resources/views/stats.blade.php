@extends('layouts.main')
@section('content')
<?php
        $user = \App\User::findOrFail($id);
?>
<div>
    <h3>{{$user->name}}</h3>
    <ul class="list-group">
        <li class="list-group-item">
            <p>HP: </p>
             <div class="progress">
                <?php
                    /*Calculate percents for progressbar */
                    $per = $user->stats->find(4)->pivot->value/$user->calcMaxHealth()*100;
                ?>
               <div class="progress-bar bg-danger" role="progressbar" style="width: {{$per}}%;" aria-valuenow="{{$user->stats->find(4)->pivot->value}}" aria-valuemin="0" aria-valuemax="{{$user->calcMaxHealth()}}">{{$user->stats->find(4)->pivot->value}}/{{$user->calcMaxHealth()}}</div>
            </div>
        </li>
        @foreach($user->stats as $stat)
           <li class="list-group-item">{{$stat->name}}: {{$stat->pivot->value}}</li>
        @endforeach
    </ul>
</div>

@stop