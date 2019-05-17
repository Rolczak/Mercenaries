@extends('layouts.main')
@section('content')
    <?php
    $user = \App\User::findOrFail($id);
    ?>
    <div>
        <h3>{{$user->name}}</h3>
        <ul class="list-group">
            <li class="list-group-item">
                <p><i class="fas fa-heart"></i> HP: </p>
                <div class="progress">
                    <?php
                    /*Calculate percents for progressbar */
                    $per = $user->getStat('currHp') / $user->calcMaxHealth() * 100;
                    ?>
                    <div class="progress-bar-striped bg-danger progress-bar-animated text-white text-center"
                         role="progressbar"
                         style="width: {{$per}}%;"
                         aria-valuenow="{{$user->getStat('currHp')}}" aria-valuemin="0"
                         aria-valuemax="{{$user->calcMaxHealth()}}">{{$user->getStat('currHp')}}
                        /{{$user->calcMaxHealth()}}</div>
                </div>
            </li>

            <li class="list-group-item">
                <p><i class="fas fa-brain"></i> XP: </p>
                <div class="progress">
                    <?php
                    /*Calculate xp for progressbar */
                    $per = $user->getStat('experience') / $user->expToNext() * 100;
                    ?>
                    <div class="progress-bar-striped progress-bar-animated bg-warning text-white text-center"
                         role="progressbar"
                         style="width: {{$per}}%;"
                         aria-valuenow="{{$user->getStat('experience')}}" aria-valuemin="0"
                         aria-valuemax="{{$user->expToNext()}}">{{$user->getStat('experience')}}
                        /{{$user->expToNext()}}</div>
                </div>
            </li>
        </ul>
        <ul class="list-group mt-1">
            <li class="list-group-item"><i class="fas fa-dumbbell"></i> {{ucfirst($user->stats->find(1)->name)}}
                : {{$user->getStat('strength')}}
                + {{$user->calcItemBonus('strength')}} = {{$user->calcStat('strength')}}
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{($user->getStat('strength')/$user->calcStat('strength'))*100 }}%"
                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
            <li class="list-group-item"><i class="fas fa-crosshairs"></i> {{ucfirst($user->stats->find(2)->name)}}
                : {{$user->getStat('accuracy')}}
                + {{$user->calcItemBonus('accuracy')}} = {{$user->calcStat('accuracy')}}
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{($user->getStat('accuracy')/$user->calcStat('accuracy'))*100 }}%"
                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
            <li class="list-group-item"><i class="fas fa-money-bill-wave"></i> {{ucfirst($user->stats->find(3)->name)}}
                : {{$user->getStat('bargaining')}}
                + {{$user->calcItemBonus('bargaining')}} = {{$user->calcStat('bargaining')}}
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{($user->getStat('bargaining')/$user->calcStat('bargaining'))*100 }}%"
                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </li>
            </li>
            <li class="list-group-item "><i class="fas fa-hand-rock"></i> Damage: {{$user->minDamage()}}
                - {{$user->maxDamage()}} dmg
            </li>
            <li class="list-group-item"><i class="fas fa-shield-alt"></i> Armor: {{$user->calcStat('defense')}}</li>
        </ul>
        <div class="jumbotron my-1">
            <div class="row">
                <div class="text-white mx-auto">
                    <div class="mx-auto text-center">
                        <h4>Equipped</h4>
                        <h4>Weapon</h4>
                    </div>
                    @if($user->hasEquipped('weapon'))
                        <div class="card bg-light text-white mx-auto " style="max-width: 20rem;">
                            <img class="card-img-top img-fluid "
                                 src="{{asset($user->getEquipped('weapon')->base_item->image_path)}}"
                                 alt="image of item">
                            <h5 class="mt-1 card-title text-center"
                                style="">{{$user->getEquipped('weapon')->name}}</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($user->getEquipped('weapon')->stats as $stat)
                                    <li class="list-group-item">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                                @endforeach
                                <li class="list-group-item" style="color: {{$user->getEquipped('weapon')->color}};">
                                    Quality: {{$user->getEquipped('weapon')->color}}</li>
                            </ul>
                            @if($user->id==Auth::user()->id)
                                <a href="{{action('HomeController@unEquip', ['item'=>$user->getEquipped('weapon')])}}"
                                   class="card-link">
                                    <button class="btn btn-primary my-2 btn-lg btn-block">UnEquip</button>
                                </a>
                            @endif
                        </div>
                    @else
                        none
                    @endif

                </div>

                <div class=" text-white mx-auto">
                    <div class="mx-auto text-center">
                        <h4>Equipped</h4>
                        <h4>Armor</h4>
                    </div>
                    @if($user->hasEquipped('armor'))
                        <div class="card bg-light" style="max-width: 20rem;">
                            <img class="card-img-top img-fluid"
                                 src="{{asset($user->getEquipped('armor')->base_item->image_path)}}"
                                 alt="image of item">
                            <h5 class="mt-1 card-title text-center"
                            >{{$user->getEquipped('armor')->name}}</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($user->getEquipped('armor')->stats as $stat)
                                    <li class="list-group-item">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                                @endforeach
                                <li class="list-group-item" style="color: {{$user->getEquipped('armor')->color}};">
                                    Quality: {{$user->getEquipped('armor')->color}}</li>
                            </ul>
                            @if($user->id==Auth::user()->id)
                                <a href="{{action('HomeController@unEquip', ['item'=>$user->getEquipped('armor')])}}"
                                   class="card-link">
                                    <button class="btn btn-primary my-2 btn-lg btn-block">UnEquip</button>
                                </a>
                            @endif
                        </div>
                    @else
                        none
                    @endif
                </div>
            </div>
        </div>
        @if(Auth::user()->id == $user->id)
            <div class="jumbotron my-1">
                <h1 class="text-center">Equipment</h1>
                <hr class="my-4">
                <div class="row mx-auto">
                    @foreach($user->getAllItems() as $item)
                        <div class="card bg-light text-white mr-1 mb-1 h-100 justify-content-center mx-auto"
                             style="max-width: 20rem;">
                            <img class="card-img-top img-fluid" src="{{asset($item->base_item->image_path)}}"
                                 alt="image of item">
                            <hr class="my-1">
                            <h5 class="card-title text-center ">{{$item->name}}</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($item->stats as $stat)
                                    <li class="list-group-item">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                                @endforeach
                                <li class="list-group-item" style="color: {{$item->color}};">
                                    Quality: {{$item->color}}</li>
                            </ul>
                            @if($user->id==Auth::user()->id)
                                <a href="{{action('HomeController@equip', ['item'=>$item])}}" class="card-link">
                                    <button class="btn btn-primary my-2 btn-lg btn-block">Equip</button>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    @endif

@stop