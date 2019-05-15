<?php

namespace App\Http\Controllers;

use App\Contract;
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
        $enemyHP = $enemy->getStat('currHp');
        $userHP = $user->getStat('currHp');
        $i = 0;
        $userHits = [];
        $enemyHits = [];
        while ($userHP > 0 && $enemyHP > 0) {
            $uHitChance = $user->getStat('accuracy') / $enemy->getStat('accuracy');
            $eHitChance = $enemy->getStat('accuracy') / $user->getStat('accuracy');
            $chance = rand(0, 10) / 10;

            if ($uHitChance > $chance) {
                $dmg = rand($user->MinDamage(), $user->MaxDamage());
                $reduction = Enemy::clamp(($enemy->getStat('defense') / $dmg), 0, 0.75);
                $hit = Enemy::clamp($dmg - $dmg * $reduction, 0, $enemyHP);
                $enemyHP -= $hit;
                $userHits[$i] = 'You hit an enemy for ' . $hit . ' dmg.';
            } else {
                $userHits[$i] = 'Enemy avoid your attack';
            }
            if ($eHitChance > $chance) {
                $dmg = rand($enemy->MinDamage(), $enemy->MaxDamage());
                $reduction = Enemy::clamp(($user->calcStat('defense') / $dmg), 0, 0.75);
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
            $user->update(['action_points' => $user->action_points - $contract->energy, 'finish_job' => Carbon::now()->addMinutes($contract->time)]);
            return view('report', compact('user', 'enemy', 'contract', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won'));
        } else {
            $user->update(['action_points' => $user->action_points - $contract->energy, 'credits' => $user->credits + $contract->credits, 'finish_job' => Carbon::now()->addMinutes($contract->time)]);
            $user->setStat('experience', $user->getStat('experience') + $contract->exp);
            $won = true;
            return view('report', compact('user', 'enemy', 'contract', 'userHits', 'enemyHits', 'enemyHP', 'userHP', 'won'));
        }
    }

}
