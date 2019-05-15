@extends('layouts.main')
@section('content')
    <?php
    $user = \App\User::findOrFail($id);
    ?>
    <div>
        <h3>{{$user->name}}</h3>
        <ul class="list-group">
            <li class="list-group-item">
                <p>HP: </p>
                <div class="progress">
                    <?php
                    /*Calculate percents for progressbar */
                    $per = $user->getStat('currHp') / $user->calcMaxHealth() * 100;
                    ?>
                    <div class="progress-bar bg-danger text-dark" role="progressbar" style="width: {{$per}}%;"
                         aria-valuenow="{{$user->getStat('currHp')}}" aria-valuemin="0"
                         aria-valuemax="{{$user->calcMaxHealth()}}">{{$user->getStat('currHp')}}
                        /{{$user->calcMaxHealth()}}</div>
                </div>
            </li>

            <li class="list-group-item">
                <p>XP: </p>
                <div class="progress">
                    <?php
                    /*Calculate xp for progressbar */
                    $per = $user->getStat('experience') / $user->expToNext() * 100;
                    ?>
                    <div class="progress-bar bg-warning text-dark" role="progressbar" style="width: {{$per}}%;"
                         aria-valuenow="{{$user->getStat('experience')}}" aria-valuemin="0"
                         aria-valuemax="{{$user->expToNext()}}">{{$user->getStat('experience')}}
                        /{{$user->expToNext()}}</div>
                </div>
            </li>
            <li class="list-group-item">{{ucfirst($user->stats->find(1)->name)}}: {{$user->getStat('strength')}}
                + {{$user->calcItemBonus('strength')}} = {{$user->calcStat('strength')}} </li>
            <li class="list-group-item">{{ucfirst($user->stats->find(2)->name)}}: {{$user->getStat('accuracy')}}
                + {{$user->calcItemBonus('accuracy')}} = {{$user->calcStat('accuracy')}} </li>
            <li class="list-group-item">{{ucfirst($user->stats->find(3)->name)}}: {{$user->getStat('bargaining')}}
                + {{$user->calcItemBonus('bargaining')}} = {{$user->calcStat('bargaining')}} </li>
            <li class="list-group-item">Damage: {{$user->minDamage()}} - {{$user->maxDamage()}} dmg</li>
            <li class="list-group-item">Armor: {{$user->calcStat('defense')}}</li>
        </ul>
        <h2>Weapon: </h2>
        @if($user->hasEquipped('weapon'))
            <div class="card col-md-3 bg-dark text-white ">
                <img class="card-img-top img-fluid "
                     src="{{asset($user->getEquipped('weapon')->base_item->image_path)}}" alt="image of item">
                <h5 class="card-title">{{$user->getEquipped('weapon')->base_item->name}}</h5>
                <ul class="list-group list-group-flush">
                    @foreach($user->getEquipped('weapon')->stats as $stat)
                        <li class="list-group-item bg-dark">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                    @endforeach
                </ul>
                @if($user->id==Auth::user()->id)
                    <a href="{{action('HomeController@unEquip', ['item'=>$user->getEquipped('weapon')])}}"
                       class="card-link">
                        <button class="btn btn-outline-light my-1">UnEquip</button>
                    </a>
                @endif
            </div>
        @else
            none
        @endif

        <h2>Armor: </h2>
        @if($user->hasEquipped('armor'))
            <div class="card col-md-3 bg-dark text-white">
                <img class="card-img-top img-fluid" src="{{asset($user->getEquipped('armor')->base_item->image_path)}}"
                     alt="image of item">
                <h5 class="card-title">{{$user->getEquipped('armor')->base_item->name}}</h5>
                <ul class="list-group list-group-flush">
                    @foreach($user->getEquipped('armor')->stats as $stat)
                        <li class="list-group-item bg-dark">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                    @endforeach
                </ul>
                @if($user->id==Auth::user()->id)
                    <a href="{{action('HomeController@unEquip', ['item'=>$user->getEquipped('armor')])}}"
                       class="card-link">
                        <button class="btn btn-outline-light my-1">UnEquip</button>
                    </a>
                @endif
            </div>
        @else
            none
        @endif

        <br/>

        <div class="row">
            @foreach($user->getAllItems() as $item)
                <div class="card col-md-3 bg-dark text-white ml-1">
                    <img class="card-img-top img-fluid" src="{{asset($item->base_item->image_path)}}"
                         alt="image of item">
                    <h5 class="card-title">{{$item->base_item->name}}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($item->stats as $stat)
                            <li class="list-group-item bg-dark">{{ucfirst($stat->name)}}: {{$stat->pivot->value}}</li>
                        @endforeach
                    </ul>
                    @if($user->id==Auth::user()->id)
                        <a href="{{action('HomeController@equip', ['item'=>$item])}}" class="card-link">
                            <button class="btn btn-outline-light my-1">Equip</button>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@stop