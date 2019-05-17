@extends('layouts.main')
@section('content')
<div class="text-center m-auto bg-danger">
    <h1 class="text-white p-1 ">You are banned to: {{$ban->expired}}</h1>
    <h1 class="text-white p-1">For: {{$ban->reason}}</h1>
    <h1 class="text-white p-1">By: {{\App\User::find($ban->giver_id)->name}}</h1>
</div>
@stop