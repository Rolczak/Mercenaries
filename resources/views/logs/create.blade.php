@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col">
    <h2>Add new log</h2>
        <form class="form form-horizontal" method="POST" action="{{action('LogController@store')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" name="ltitle" type="text" aria-describedby="titleHelp" placeholder="Enter Title">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" rows="3" name="lcontent" placeholder="Enter Content Here"></textarea>
            </div>

            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
        </div>
    </div>
@endsection('content')