<?php

namespace App\Http\Controllers;

use App\Quest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index()
    {
        if(auth()->user()->quests->first() == null)
            $next = Quest::all()->first();
        else
            $next = Quest::all()->where('id', (auth()->user()->quests->last()->id+1))->first();

        $completed = auth()->user()->quests;
        return view('quests', compact('next','completed'));
    }

    public function start()
    {
        $id = request()->quest;
        $quest = Quest::find($id);
        $user = auth()->user();
        switch ($id)
        {
            case 1:
                $user->update(['action_points' => $user->action_points - $quest->energy, 'finish_job' => Carbon::now()->addMinutes($quest->time)]);
                $user->items()->sync([1,2]);
                $user->quests()->syncWithoutDetaching([1]);
                $name = 'awakening';
                return view('questSum', compact('name'));
                break;
            case 2:
                if(($user->getEquipped('weapon') != null) && ($user->getEquipped('armor') != null))
                {
                    $user->quests()->syncWithoutDetaching([2]);
                    $name = 'equip';
                    return view('questSum', compact('name'));
                }
                else
                {

                    return redirect()->back()->with('err', 'You have to equip armor and weapon to complete this mission');
                }
                break;
            case 3:
                $user->update(['action_points' => $user->action_points - $quest->energy, 'finish_job' => Carbon::now()->addMinutes($quest->time)]);
                $name = 'people';
                $user->quests()->syncWithoutDetaching([3]);
                return view('questSum', compact('name'));
                break;
            case 4:
                if($user->getStat('accuracy') >= 5)
                {
                    $name = 'shop';
                    $user->quests()->syncWithoutDetaching([4]);
                    return view('questSum', compact('name'));
                }
                return redirect()->back()->with('err', 'You have to train your accuracy to min 5 lvl of accuracy');
                break;
        }
    }

}
