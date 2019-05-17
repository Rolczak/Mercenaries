@extends('layouts.main')
@section('content')
    <div class="jumbotron">
        <img >
        <h1 class="display-2">{{$name}}</h1>
        <hr>
        <div class="">
            @include('quests.'.$name)
        </div>
    </div>

@stop