<?php

namespace App\Http\Controllers;

use App\Ban;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function index()
    {
        $bans = Ban::all()->where('removed', '0');
        return view('bans.index', compact('bans'));
    }
    public function store(Request $request){
        Ban::create(['user_id' => $request->id,
            'reason' => $request->reason,
            'expired' => Carbon::parse($request->expired),
            'giver_id' => auth()->id(),
            'removed' => 0,]);
        return redirect()->back();
    }

    public function create()
    {
        return view('bans.create');
    }

    public function remove()
    {
        $ban = Ban::find(request()->ban_id);
        $ban->update(['removed' => '1']);
        return redirect()->back();
    }

}
