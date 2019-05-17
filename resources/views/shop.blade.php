@extends('layouts.main')
@section('content')

    <div class="jumbotron my-1">
        <h1 class="display-3">Shop</h1>
        <p class="lead">Here you can buy or sell items.</p>
        <hr class="my-4">
        <h1 class="display-4">Buy Items</h1>
        <div class="row mx-auto">
            @foreach($items as $item)
                <div class="card bg-light text-white mr-1 mb-1 h-100 justify-content-center mx-auto"
                     style="max-width: 20rem;">
                    <img class="card-img-top img-fluid" src="{{asset($item->base_item->image_path)}}"
                         alt="image of item">
                    <hr class="my-1">
                    <h5 class="card-title text-center ">{{$item->name}}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($item->stats as $stat)
                            <li class="list-group-item">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                        @endforeach
                        <li class="list-group-item" style="color: {{$item->color}};">
                            Quality: {{$item->color}}</li>
                        <li class="list-group-item">Price: {{$item->price}} Credits</li>
                    </ul>
                    <form  method="post" action="{{action('ShopController@buyItem')}}">
                        @csrf
                        <input name="item" type="hidden" value="{{$item->id}}"/>
                        <input type="submit" class="btn btn-primary" value="Buy"/>
                    </form>
                    <!-- Button-->
                </div>
            @endforeach
        </div>
    </div>

    <div class="jumbotron my-1">
        <h1 class="display-4">Sell Items</h1>
        <hr class="my-4">
        <div class="row mx-auto">
            @foreach($userItems as $item)
                <div class="card bg-light text-white mr-1 mb-1 h-100 justify-content-center mx-auto"
                     style="max-width: 20rem;">
                    <img class="card-img-top img-fluid" src="{{asset($item->base_item->image_path)}}"
                         alt="image of item">
                    <hr class="my-1">
                    <h5 class="card-title text-center ">{{$item->name}}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($item->stats as $stat)
                            <li class="list-group-item">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                        @endforeach
                        <li class="list-group-item" style="color: {{$item->color}};">
                            Quality: {{$item->color}}</li>
                        <li class="list-group-item">Price: {{$item->price}} Credits</li>
                    </ul>
                    <form  method="post" action="{{action('ShopController@sellItem')}}">
                        @csrf
                        <input name="item" type="hidden" value="{{$item->id}}"/>
                        <input type="submit" class="btn btn-primary" value="Sell"/>
                    </form>
                    <!-- Button-->
                </div>
            @endforeach
        </div>
    </div>
@stop

