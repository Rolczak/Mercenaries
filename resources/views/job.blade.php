@extends('layouts.main')

@section('content')

<div class="text-center m-auto border rounded">
    <h1 class="bg-info text-white p-1 rounded">You are resting for:</h1>
    <h1 id="jobTimer"></h1>
    <a class="btn btn-dark text-white" href="{{action('UraniumController@modRest')}}">Speed Up</a>
</div>

<script>
        var countDownDate = new Date("{{Auth::User()->getJobTime()}}");
        var x = setInterval(function() {
            var now = new Date().getTime();
            var dist = countDownDate- now;
            var hours = Math.floor((dist%(1000*60*60*60))/(1000*60*60));
            var minutes =  Math.floor((dist%(1000*60*60))/(1000*60));
            var seconds =  Math.floor((dist%(1000*60))/(1000));
            document.getElementById("jobTimer").innerHTML = hours + 'h ' +minutes + 'm ' + seconds + 's';

            if(dist <0){
                clearInterval(x);
                document.getElementById("jobTimer").innerHTML = "Job Finished";
            }
        },100);

</script>
@stop