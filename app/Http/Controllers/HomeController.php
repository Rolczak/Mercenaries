<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function work()
    {
        return view('work');
    }

    public function working()
    {
        $user = Auth::user();
        $val = request()->value;
        if($val <= 0)
        {
            return redirect()->back()->with('err', 'Please select valid amount of action points.');
        }

        else if($user->action_points >= $val)
        {
            $user->action_points -= $val;
            $cash = $val*10*$user->getStat('level');
            $user->credits += $cash;
            $user->save();
            return redirect()->back()->with('mod', 'You worked for '.$val.' action points and earned '.$cash.'. ');
        }

        return redirect()->back()->with('err', 'You don\'t have action points to perform this action.');
    }

    public function train()
    {
        $stat = request()->stat;
        $user = Auth::user();
        $cost = $user->calcTrainingCost($stat);
        if($user->credits >= $cost )
        {
            $user->credits -= $cost;
            $val =   $user->stats->find($stat)->pivot->value+1;
            $user->stats()->updateExistingPivot($stat, ['value'=>$val]);
            $user->save();

        }
        return back();
    }

    public function equip()
    {
        Auth::user()->equip(Item::find(request()->item));
        return back();
    }

    public function unEquip()
    {
        Auth::user()->unEquip(Item::find(request()->item));
        return back();
    }

    public function contracts()
    {
        $contracts = Contract::all();
        return view('contracts', compact('contracts'));
    }

}
