<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    public function contracts()
    {
        return $this->belongsToMany(Contract::class);
    }

    public function stats()
    {
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }


    public function getStat($stat)
    {
        return $this->stats->where('name', $stat)->first()->pivot->value;
    }

    public function MinDamage()
    {
        return self::clamp($this->getStat('damage') - 0.1 * $this->getStat('damage'),1,999);
    }

    public function MaxDamage()
    {
        return self::clamp($this->getStat('damage') + 0.1 * $this->getStat('damage'),1,999);
    }

    public static function  clamp($current, $min, $max) {
        return max($min, min($max, $current));
    }

}
