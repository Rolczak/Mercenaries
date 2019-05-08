<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;

class FightController extends Controller
{
    public function fight()
    {
        $contract = Contract::find(request()->contract_id);
        $enemy = $contract->randEnemy();
        return $enemy;
    }

}
