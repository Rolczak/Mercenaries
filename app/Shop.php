<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable =['user_id', 'update_time'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function generateItemsForShop($user)
    {
        $it= [];
       for($i=0; $i<5; $i++)
       {
          $item = ItemGenerator::generateItem($user->getStat('level'));
          $it[$i] = $item->id;
       }
       $this->update(['update_time' => Carbon::now()]);
       $this->items()->sync($it);
    }
}
