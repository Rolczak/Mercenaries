<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('value');
    }
}
