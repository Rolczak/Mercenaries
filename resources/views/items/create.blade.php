@extends('layouts.main')
@section('content')
<?php
$stat = 0;
?>
    <div class="row">
        <div class="col">
            <h2>Add new item</h2>
            <form id="create" class="form form-horizontal" method="POST" action="{{action('ItemController@store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" aria-describedby="nameHelp" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="image">Name</label>
                    <input class="form-control" id="image" name="image_path" type="text" aria-describedby="imageHelp" placeholder="/img/type/item.ext">
                </div>
                <select name="type" form="edit">
                    <option value="weapon">Weapon</option>
                    <option value="armor">Armor</option>
                </select>
                <div class="row">
                    <select name="stat-1" form="create">
                        @foreach(\App\Stat::all() as $stat)
                            <option value="{{$stat->name}}">{{$stat->name}}</option>
                        @endforeach
                            <input type="number" name="stat-1-val">
                    </select>


                </div>

            </form>
            <button class="btn btn-primary" id="but">+</button>
        </div>

    </div>

    <button type="submit" form="create" class="btn btn-dark">Submit</button>

@endsection('content')