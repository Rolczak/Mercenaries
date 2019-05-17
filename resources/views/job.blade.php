@extends('layouts.main')

@section('content')

<div class="text-center m-auto border border-info">
    <h1 class="bg-info text-white p-1 ">You are resting for:</h1>
    <h1 id="jobTimer"></h1>
    <a class="btn btn-secondary my-1" href="{{action('UraniumController@modRest')}}">Speed Up</a>
</div>

<script>
        var countDownDatea = new Date("{{Auth::User()->getJobTime()}}");
        var xa = setInterval(function() {
            var nowa = new Date().getTime();
            var dista = countDownDatea- nowa;
            var hoursa = Math.floor((dista%(1000*60*60*60))/(1000*60*60));
            var minutesa =  Math.floor((dista%(1000*60*60))/(1000*60));
            var secondsa =  Math.floor((dista%(1000*60))/(1000));
            document.getElementById("jobTimer").innerHTML = hoursa + 'h ' +minutesa + 'm ' + secondsa + 's';

            if(dista <0){
                clearInterval(xa);
                document.getElementById("jobTimer").innerHTML = "You finished resting";
            }
        },100);

</script>
@stop