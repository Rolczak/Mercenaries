@extends('layouts.main')

@section('content')
    <h3>Tu jest strona związana z zarabianiem piniędzorów przez pracę. </h3>
    <br/><h3>Jeszcze nie zdecydowałem czy będzie to akord czy godzinowa praca</h3>

    @if(Session::has('err'))
        <div class="modal fade" id="errModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel">An Error Occurred During Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-danger">
                        {{Session::get('err')}}
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){

                $("#errModal").modal('show');

            });
        </script>

        @elseif(Session::has('mod'))
        {{Session::get('mod')}}
        <div class="modal fade" id="dialModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{Session::get('mod')}}
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){

                $("#dialModal").modal('show');

            });
        </script>

    @endif
<div class="row">
    <div class="col">
    <form class="form" method="post" action="{{route('work')}}">
        @csrf
        <label for="id">How many action points You want to spend?</label>
        <input class="form-control" id="workhours" type="number" name="value" min="0">
        <input class="btn-dark" type="submit" value="Work!">
    </form>
    </div>
</div>
@stop

