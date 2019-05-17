@extends('layouts.main')
@section('content')
    <div class="jumbotron">
        <table class="table table-light text-white">
            <thead class="thead bg-danger">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Reason</th>
                <th>Expired</th>
                <th>Givers ID</th>
                <th>Unban</th>
            </tr>
            </thead>


            @foreach($bans as $ban)
                <tr>
                    <td>{{$ban->id}}</td>
                    <td>{{$ban->user_id}}</td>
                    <td>{{$ban->reason}}</td>
                    <td>{{$ban->expired}}</td>
                    <td>{{$ban->giver_id}}</td>
                    <td>
                        <form class="form form-horizontal" method="POST"
                              action="{{action('BanController@remove')}}">
                            @csrf
                            <input type="hidden" name="ban_id" value="{{$ban->id}}">
                            <input type="submit" class="btn btn-success" value="Unban">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop