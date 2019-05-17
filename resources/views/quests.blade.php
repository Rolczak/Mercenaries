@extends('layouts.main')
@section('content')

    <div class="jumbotron">
        <h1 class="display-3">Current Quest</h1>
        @if($next != null)
            <div class="row">
                <div class="card mx-auto bg-light">
                    <img class="card-img-top" src="{{asset($next->image_path)}}"/>
                    <h3 class="card-title">{{$next->title}}</h3>
                    @if($next->description != '')
                        <p class="card-text">{{$next->description}}</p>
                    @endif
                    @if($next->time != '')
                        <p class="card-text text-muted">Time: {{$next->time}} min</p>
                    @endif
                    @if($next->energy != '')
                        <p class="card-text text-muted">Energy: {{$next->energy}} energy</p>
                    @endif
                    <form method="post" action="{{action('QuestController@start')}}">
                        @csrf
                        <input type="hidden" name="quest" value="{{$next->id}}">
                        <input type="submit" class="btn btn-primary" value="Start Quest"/>
                    </form>

                </div>
            </div>
        @else
            <p>You don't have new quests</p>
        @endif
    </div>

    <div class="jumbotron">
        <h1 class="display-3">Completed quests</h1>
        @if($completed != null)
            <div class="row">
                @foreach($completed as $complete)

                    <div class="card mx-auto bg-light col-md-3">
                        <img class="card-img-top" src="{{asset($complete->image_path)}}"/>
                        <h3 class="card-title">{{$complete->title}}</h3>
                        @if($complete->description != '')
                            <p class="card-text">{{$complete->description}}</p>
                        @endif
                    </div>


            @endforeach
            </div>
    @endif
    </div>
@stop