<?php

namespace App\Http\Controllers;

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
        if($val < 0)
        {
            redirect('home');
        }

        else if($user->actionpoints >= $val)
        {
            $user->actionpoints -= $val;
            $user->credits += $val*10;
            $user->save();
            return view('work');
        }

        return view('home');
    }

    public function train()
    {
        $stat = request()->stat;
        $user = Auth::user();
        $cost = $user->calcTrainingCost($stat);
        if($user->credits >= $cost )
        {
            $user->credits -= $cost;
            return $user->stats->find($stat)->pivot->value;
          return  $val =  $user->stats->pivot()->wherePivot('stat_id', $stat)->value;
            $user->stats()->updateExistingPivot($stat, ['value'=>$val]);

        }
        return view('training');
    }

}
