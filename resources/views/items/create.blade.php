@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col">
            <h2>Add new item</h2>
            <form class="form form-horizontal" method="POST" action="{{action('ItemController@store')}}">
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

                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection('content')