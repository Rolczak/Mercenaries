<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function stats(){
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function base_item()
    {
        return $this->belongsTo(BaseItem::class);
    }
}
