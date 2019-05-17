<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UraniumController extends Controller
{
    public function speedUpRest()
    {
        if (request()->user()->uranium < request()->val) {
            return redirect('uranium');
        } else {
            request()->user()->payJob(request()->val);
            return redirect('home');
        }
    }

    public function modRest()
    {
        if (Auth::user()->hasJob())
            return redirect()->back()->with('microTitle', 'Uranium Shop')->with('micro', 'Speed up resting and don\'t waste time for only')->with('microVal', 1);

        return redirect('home')->with('errTitle', 'Error')->with('err', 'You don\'t have to speed up work');
    }

    public function addUranium()
    {
        request()->user()->uranium += request()->val;
        request()->user()->save();
        return redirect()->back()->with('modTitle', '<3')->with('mod', 'Thank you for the purchase');
    }

    public function regenHealth()
    {
        if (request()->user()->uranium < request()->val) {
            return redirect()->back()->with('errTitle', 'Poor')->with('err', 'You don\'t have enough uranium.');
        }
        request()->user()->setStat('currHp', request()->user()->calcMaxHealth());
        request()->user()->uranium -= request()->val;
        request()->user()->save();
        return redirect()->back()->with('modTitle', '<3')->with('mod', 'Thank you for the purchase. Your health points is now restored.');
    }

    public function regenAction()
    {
        if (request()->user()->uranium < request()->val) {
            return redirect()->back()->with('errTitle', 'Poor')->with('err', 'You don\'t have enough uranium.');
        }
        request()->user()->action_points = 500;
        request()->user()->uranium -= request()->val;
        request()->user()->save();
        return redirect()->back()->with('modTitle', '<3')->with('mod', 'Thank you for the purchase. Your action points is now restored.');
    }
}
