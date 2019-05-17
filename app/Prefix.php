<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    public function stats()
    {
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }
}
