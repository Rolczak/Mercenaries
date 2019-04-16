@extends('layouts.main')

@section('content')
    <h3>Tu jest strona związana z zarabianiem piniędzorów przez pracę. </h3>
    <br/><h3>Jeszcze nie zdecydowałem czy będzie to akord czy godzinowa praca</h3>
<div class="row">
    <div class="col">
    <form class="form" method="post" action="/work">
        @csrf
        <label for="id">How many action points You want to spend?</label>
        <input class="form-control" id="workhours" type="number" name="value" min="0">
        <input class="btn-dark" type="submit" value="Work!">
    </form>
    </div>
</div>
@stop
