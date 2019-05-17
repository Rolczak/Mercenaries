<?php

namespace App\Http\Controllers;

use App\Contract;
use App\ItemGenerator;
use App\Notifications\Attacked;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Enemy;

class FightController extends Controller
{

    public function fight()
    {

        $contract = Contract::find(request()->contract_id);
        $enemy = $contract->randEnemy();
        $user = Auth::user();
        if ($user->action_points < $contract->energy)
            return redirect()->back()->with('errTitle', 'Error')->with('err', 'You don\'t have enough action points.');
        if ($user->getStat('level') < $contract->min_level)
            return redirect()->back()->with('errTitle', 'Error')->with('err', 'You don\'t have enough experience.');
        if ($user->getStat('currHp') < 5)
            return redirect()->back()->with('errTitle', 'Error')->with('err', 'You don\'t have enough health.');

        $i = 0;
        $userHits = [];
        $enemyHits = [];


        //User Stats
        $uHitChance = $user->calcStat('accuracy') / $enemy->getStat('accuracy');
        $uDmgMin = $user->MinDamage();
        $uDmgMax = $user->MaxDamage();
        $uDef = $user->calcStat('defense');
        $userHP = $user->getStat('currHp');

        //Enemy Stats
        $eHitChance = $enemy->getStat('accuracy') / $user->calcStat('accuracy');
        $eDmgMin = $enemy->MinDamage();
        $eDmgMax = $enemy->MaxDamage();
        $eDef = $user->getStat('defense');
        $enemyHP = $enemy->getStat('currHp');

        while ($userHP > 0 && $enemyHP > 0) {

            $chance = rand(0, 10) / 10;

            if ($uHitChance > $chance) {
                $dmg = rand($uDmgMin, $uDmgMax);
                $reduction = Enemy::clamp(($eDef / $dmg), 0, 0.75);
                $hit = Enemy::clamp($dmg - $dmg * $reduction, 0, $enemyHP);
                $enemyHP -= $hit;
                $userHits[$i] = 'You hit an enemy for ' . $hit . ' dmg.';
            } else {
                $userHits[$i] = 'Enemy avoid your attack';
            }

            if ($eHitChance > $chance) {
                $dmg = rand($eDmgMin, $eDmgMax );
                $reduction = Enemy::clamp(($uDef / $dmg), 0, 0.75);
                $hit = Enemy::clamp($dmg - $dmg * $reduction, 0, $userHP);
                $userHP -= $hit;
                $enemyHits[$i] = 'You have been hit by an enemy for ' . $hit . ' dmg.';
            } else {
                $enemyHits[$i] = 'You avoid enemy attack.';
            }
            $i++;

        }
        $user->setStat('currHp', $user->getStat('currHp')-0.25*($user->getStat('currHp')-$userHP));
        if ($userHP == 0) {
            $won = false;
            $item = null;
            $user->update(['action_points' => $user->action_points - $contract->energy, 'finish_job' => Carbon::now()->addMinutes($contract->time)]);
            return view('report', compact('user', 'enemy', 'contract', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won','item'));
        } else {
            $cash = $contract->credits+0.1*$user->calcStat('bargaining')*$contract->credits;
            $loot = rand(1,100);
            $user->update(['action_points' => $user->action_points - $contract->energy, 'credits' => $user->credits + $cash, 'finish_job' => Carbon::now()->addMinutes($contract->time)]);
            $user->setStat('experience', $user->getStat('experience') + $contract->exp);
            $won = true;
            $item = null;
            if($loot < 50)
            {
                $item = ItemGenerator::generateItem($contract->min_level);
                $item->users()->attach($user->id);
            }
            return view('report', compact('user', 'enemy', 'contract', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won', 'cash', 'item'));
        }
    }

    public function fightArena()
    {
        $enemy = User::find(request()->val);
        $user = Auth::user();
        if ($user->action_points < 5)
            return redirect()->back()->with('errTitle', 'Error')->with('err', 'You don\'t have enough action points.');
        if ($user->getStat('currHp') < 5)
            return redirect()->back()->with('errTitle', 'Error')->with('err', 'You don\'t have enough health.');
        $enemyHP = $enemy->getStat('currHp');
        $userHP = $user->getStat('currHp');
        $i = 0;
        $userHits = [];
        $enemyHits = [];

        //User Stats
        $uHitChance = $user->calcStat('accuracy') / $enemy->calcStat('accuracy');
        $uDmgMin = $user->MinDamage();
        $uDmgMax = $user->MaxDamage();
        $uDef = $user->calcStat('defense');
        $userHP = $user->getStat('currHp');

        //Enemy Stats
        $eHitChance = $enemy->calcStat('accuracy') / $user->calcStat('accuracy');
        $eDmgMin = $enemy->MinDamage();
        $eDmgMax = $enemy->MaxDamage();
        $eDef = $enemy->calcStat('defense');
        $enemyHP = $enemy->getStat('currHp');

        while (($userHP > 0 && $enemyHP > 0) && $i <30) {

            $chance = rand(0, 10) / 10;

            if ($uHitChance > $chance) {
                $dmg = rand($uDmgMin, $uDmgMax);
                $reduction = Enemy::clamp((($eDef*0.5) / $dmg), 0, 0.75);
                $hit = Enemy::clamp($dmg - $dmg * $reduction, 0, $enemyHP);
                $enemyHP -= $hit;
                $userHits[$i] = 'You hit an enemy for ' . $hit . ' dmg.';
            } else {
                $userHits[$i] = 'Enemy avoid your attack';
            }

            if ($eHitChance > $chance) {
                $dmg = rand($eDmgMin,$eDmgMax);
                $reduction = Enemy::clamp((($uDef*0.5) / $dmg), 0, 0.75);
                $hit = Enemy::clamp($dmg - $dmg * $reduction, 0, $userHP);
                $userHP -= $hit;
                $enemyHits[$i] = 'You have been hit by an enemy for ' . $hit . ' dmg.';
            } else {
                $enemyHits[$i] = 'You avoid enemy attack.';
            }
            $i++;

        }
        if($i >= 30)
        {
            if($userHP > $enemyHP)
                $enemyHP = 0;
            else
                $userHP = 0;
        }
        $user->setStat('currHp', $user->getStat('currHp')-0.25*($user->getStat('currHp')-$userHP));
        $enemy->setStat('currHp', $enemy->getStat('currHp')-0.25*($enemy->getStat('currHp')-$enemyHP));
        if ($userHP == 0) {
            $won = false;
            $user->update(['action_points' => $user->action_points - 5, 'finish_job' => Carbon::now()->addMinutes(5)]);
            $enemy->notify(new Attacked($user, 'won'));
            return view('arenaReport', compact('user', 'enemy', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won'));
        } else {
            $cash = $enemy->getStat('level')*200+$user->calcStat('bargaining')*($enemy->getStat('level')*2);
            $user->update(['action_points' => $user->action_points - 5, 'credits' => $user->credits + $cash, 'finish_job' => Carbon::now()->addMinutes(5)]);
            $exp =  $enemy->getStat('level')*10;
            $user->setStat('experience', $user->getStat('experience') + $exp);
            $won = true;
            $enemy->notify(new Attacked($user, 'lost'));
            return view('arenaReport', compact('user', 'enemy', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won', 'cash', 'exp'));
        }
    }

}
