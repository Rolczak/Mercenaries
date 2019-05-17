@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <h1>Changelog:</h1>
        <ul class="list-group">
            @foreach(\App\Log::all()->sortByDesc('id') as $log)
                <li class="list-group-item">
                    <div class="card text-white bg-light">
                        <div class="card-body">
                            <span class="text-right"><small>{{$log->created_at}}</small></span>
                            <h5 class="card-title">{{$log->id}}. {{$log->title}}</h5>
                            <pre class="card-text">{{$log->content}}</pre>
                            <p class="text-right"><a href="{{url('/show/'.$log->user->id)}}">{{$log->user->name}}</a></p>

                        </div>
                    </div>
                    <br/>
            @endforeach
        </ul>
    </div>


@endsection('content')