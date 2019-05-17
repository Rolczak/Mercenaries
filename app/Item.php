<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function stats(){
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function base_item()
    {
        return $this->belongsTo(BaseItem::class);
    }
}
