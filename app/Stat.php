<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('value');
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot('value');
    }

    public function enemies(){
        return $this->belongsToMany(Enemy::class)->withPivot('value');
    }
}
