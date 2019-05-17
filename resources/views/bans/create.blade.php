@extends('layouts.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.datetimepicker.min.css')}}"/>
@endsection
@section('content')
    <?php
    $stat = 0;
    ?>
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h2>Add new ban</h2>
                <form id="create" class="form form-horizontal" method="POST" action="{{action('BanController@store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input class="form-control" id="id" name="id" type="number" min="1"
                               placeholder="Enter User ID">
                    </div>
                    <div class="form-group">
                        <label for="image">Name</label>
                        <input class="form-control" id="image" name="reason" type="text" placeholder="Enter Reason">
                    </div>
                    <div class="form-group">
                        <label for="datetimepicker">Name</label>
                        <input class="form-control" id="datetimepicker" name="expired" type="datetime-local">
                    </div>

                </form>
                <button type="submit" form="create" class="btn btn-danger">BAN</button>
            </div>

        </div>

    </div>
@endsection()

@section('scripts')
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <script>
        $('#datetimepicker').datetimepicker({
            dayOfWeekStart : 1,
            lang:'en',
            disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
            startDate:	'2019/06/07'
        });
    </script>
@endsection