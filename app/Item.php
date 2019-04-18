<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function stats(){
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('value');
    }
}
