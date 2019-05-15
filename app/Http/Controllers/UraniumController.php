<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UraniumController extends Controller
{
    public function speedUpRest()
    {
        if(request()->user()->uranium < request()->val)
        {
            return redirect('uranium');
        }
        else
        {
            request()->user()->payJob(request()->val);
            return redirect('home');
        }
    }
    public function modRest()
    {
        return redirect()->back()->with('microTitle', 'Uranium Shop')->with('micro', 'Speed up resting and don\'t waste time for only' )->with('microVal', 1);
    }
}
