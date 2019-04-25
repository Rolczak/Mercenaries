@extends('layouts.main')
@section('content')
    <h1>Edit Item nr.{{$item->id}}</h1>
    <div class="row">
        <div class="col">
            <form id="edit" class="form form-horizontal" method="POST" action="{{action('ItemController@update', [$item->id])}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" aria-describedby="nameHelp" value="{{$item->name}}">
                    <label for="image">Image Path</label>
                    <input class="form-control" id="image" name="image_path" type="text" aria-describedby="imageHelp" value="{{$item->image_path}}">
                </div>
            </form>
             <select name="type" form="edit">
                 <option value="weapon">Weapon</option>
                 <option value="armor">Armor</option>
             </select>

    <form id="delete" class="form form-horizontal" method="POST" action="{{action('ItemController@destroy', [$item->id])}}">
        @csrf
        @method('delete')

    </form>
    <button type="submit" class="btn btn-dark" form="edit">Submit</button>
    <button type="submit" class="btn btn-dark" form="delete">Delete Item</button>
        </div>
    </div>
@stop