@extends('layouts.main')
@section('content')
    <?php
    $stat = 0;
    ?>
    <div class="row">
        <div class="col">
            <div   class="jumbotron">
                <h2>Add new item</h2>
                <form id="create" class="form form-horizontal" method="POST"
                      action="{{action('ItemController@store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" aria-describedby="nameHelp"
                               placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="image">Name</label>
                        <input class="form-control" id="image" name="image_path" type="text"
                               aria-describedby="imageHelp" placeholder="/img/type/item.ext">
                    </div>
                    <select name="type" form="edit">
                        <option value="weapon">Weapon</option>
                        <option value="armor">Armor</option>
                    </select>

                </form>
                </br>
                <button type="submit" form="create" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>



@endsection('content')