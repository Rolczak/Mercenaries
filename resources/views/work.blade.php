@extends('layouts.main')

@section('content')

    <div class="jumbotron">
        <h1 class="display-3">Work</h1>
        <p class="lead">Here you can spend energy to earn money</p>
        <hr class="my-4">
        <form class="form" method="post" action="{{route('work')}}">
            @csrf
            <div class="form-group">
            <label for="workhours">How many action points You want to spend? </label>
            <input class="form-control col-md-4" id="workhours" type="number" name="value" min="0">
            </div>
            <input class="btn btn-primary" type="submit" value="Work!">
        </form>
    </div>
@stop

