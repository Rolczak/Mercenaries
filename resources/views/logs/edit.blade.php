@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1>Edit Log nr.{{$log->id}}</h1>
                <form id="edit" class="form form-horizontal" method="POST"
                      action="{{action('LogController@update', [$log->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" name="ltitle" type="text" aria-describedby="titleHelp"
                               value="{{$log->title}}">
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="lcontent" rows="3"
                                  name="lcontent">{{$log->content}}</textarea>
                    </div>

                </form>

                <form id="delete" class="form form-horizontal" method="POST"
                      action="{{action('LogController@destroy', [$log->id])}}">
                    @csrf
                    @method('delete')

                </form>
                <button type="submit" class="btn btn-primary" form="edit">Submit</button>
                <button type="submit" class="btn btn-primary" form="delete">Delete Post</button>

            </div>
        </div>
    </div>

@stop