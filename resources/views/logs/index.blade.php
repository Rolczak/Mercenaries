@extends('layouts.main')
@section('content')
<ul  class="list-group">
    @foreach($logs as $log)
        <li class="list-group-item">

            <div class="card text-white bg-dark">
                <div class="card-body">
                    <span class="text-right"><small >{{$log->created_at}}</small><a style="float: right;" class="card-link" href="{{route('logs.edit', $log->id)}}">Edit</a></span>
                  <h5 class="card-title">{{$log->id}}. {{$log->title}}</h5>
                    <p class="card-text">{{$log->content}}</p>
                    <p class="text-right">{{$log->user->name}}</p>

                </div>


            </div>
        <br/>
    @endforeach
</ul>
@stop