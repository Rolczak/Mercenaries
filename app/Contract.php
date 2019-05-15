<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function enemies()
    {
        return $this->belongsToMany(Enemy::class);
    }

    public function randEnemy()
    {
        return $this->enemies->random();
    }
}

