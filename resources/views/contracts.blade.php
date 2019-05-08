@extends('layouts.main')
@section('content')
<div class="row">
    @foreach($contracts as $contract)
          <div class="card col-md-4 mr-auto">
              <ul class="nav nav-pills card-header-tabs border-bottom" id="navTab{{$contract->id}}" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" href="#desc{{$contract->id}}" role="tab" data-toggle="tab" aria-controls="desc{{$contract->id}}" aria-selected="true">Description</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#rewards{{$contract->id}}" role="tab" data-toggle="tab" aria-controls="rewards{{$contract->id}}" aria-selected="false">Rewards</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#enemies{{$contract->id}}" role="tab" data-toggle="tab" aria-controls="enemies{{$contract->id}}" aria-selected="false">Enemies</a>
                  </li>
              </ul>

              <div class="card-body">
                  <div class="tab-content" id="navTabContent{{$contract->id}}">

                      <div class="tab-pane fade show active" id="desc{{$contract->id}}" role="tabpanel" aria-labelledby="desc{{$contract->id}}-tab">
                          <img src="{{asset($contract->image_path)}}" class="card-img-top mt-2">
                          <h4 class="card-title">{{$contract->title}}</h4>
                          <p class="card-text">{{$contract->description}}</p>
                          <ul class="list-group text-dark">
                              <li class="list-group-item">Time: {{$contract->time}}</li>
                              <li class="list-group-item">MinLevel: {{$contract->min_level}}</li>
                          </ul>
                      </div>
                      <div class="tab-pane fade show" id="rewards{{$contract->id}}" role="tabpanel" aria-labelledby="rewards{{$contract->id}}-tab">
                            jdioasjdi
                      </div>
                      <div class="tab-pane fade show" id="enemies{{$contract->id}}" role="tabpanel" aria-labelledby="enemies{{$contract->id}}-tab">
                          <ul class="list-group">
                            @foreach($contract->enemies as $enemy)
                                <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6">{{$enemy->name}}</div>
                                            <div class="col-md-6">


                                            <img src="{{asset($enemy->image_path)}}" class="img-thumbnail rounded">
                                            </div>
                                        </div>
                                    </li>
                            @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
                  <div class="card-body text-center">
                      <form id="contract{{$contract->id}}" method="post" action="{{route('fight')}}">
                          @csrf
                          <input type="hidden" value="{{$contract->id}}" name="contract_id">
                      </form>
                        <button form="contract{{$contract->id}}" class="btn btn-primary">Sign Contract</button>
                  </div>
          </div>
    @endforeach
</div>
@stop