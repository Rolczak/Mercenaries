@extends('layouts.main')
@section('content')
    <ul class="list-group">
        @foreach($items as $item)
            <a href="{{route('items.edit', $item->id)}}">
                <li class="list-group-item">

                    <div class="card text-white bg-light col-md-3">
                        <img class="card-img-top" src="{{asset($item->image_path)}}" alt="Item Image">
                        <div class="card-body">
                            <h5 class="class-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->type}}</p>
                        </div>
                    </div>

                </li>
            </a>
            <br/>
        @endforeach
    </ul>
@stop