<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGenerator extends Model
{
    public static function generateItem($lvl)
    {
        $base = BaseItem::all()->except(1,2)->random();
        $prefix = Prefix::all()->where('type', $base->type)->random();
        $item = new Item;
        $item->name = $prefix->name . ' ' . $base->name;
        $item->color = $prefix->color;
        $item->base_item_id = $base->id;
        $item->price = rand(10,500);
        $item->save();
        if ($base->type == 'weapon') {
            $dmg = rand(1, 5) * $lvl;
            //$item->stats()->attach(7);
            //$item->stats()->updateExistingPivot(7, ['value' => $dmg]);
            $item->stats()->syncWithoutDetaching([7 =>['value' =>$dmg]]);
        } else if ($base->type == 'armor') {

            $def = rand(1, 5) * $lvl;
           // $item->stats()->attach(9);
          //  $item->stats()->updateExistingPivot(9, ['value' => $def]);
            $item->stats()->syncWithoutDetaching([9 =>['value' =>$def]]);
        }

        $rand = rand(1, 100);

        //adding random stats

        //accuracy
        if ($rand < 25) {
            $val = rand(1, 5) * $lvl;
          //  $item->stats()->attach(2);
          //  $item->stats()->updateExistingPivot(2, ['value' => $val]);
            $item->stats()->syncWithoutDetaching([2 =>['value' =>$val]]);
        }
        $rand = rand(1, 100);
        //strength
        if ($rand < 25) {
            $val = rand(1, 5) * $lvl;
           // $item->stats()->attach(1);
           // $item->stats()->updateExistingPivot(1, ['value' => $val]);
            $item->stats()->syncWithoutDetaching([1 =>['value' =>$val]]);
        }
        $rand = rand(1, 100);
        //bargaining
        if ($rand < 25) {
            $val = rand(1, 5) * $lvl;
           // $item->stats()->attach(3);
          //  $item->stats()->updateExistingPivot(3, ['value' => $val]);
            $item->stats()->syncWithoutDetaching([3 =>['value' =>$val]]);
        }
        $rand = rand(1, 100);
        //damege
        if ($rand < 10) {
            $val = rand(1, 5) * $lvl;
            if ($item->stats->find(7) == null) {
                //$item->stats()->attach(7);
               // $item->stats()->updateExistingPivot(7, ['value' => $val]);
                $item->stats()->syncWithoutDetaching([7 =>['value' =>$val]]);
            } else {
                $item->stats()->updateExistingPivot(7, ['value' => $item->stats->find(7)->pivot->value + $val]);
            }
        }
        $rand = rand(1, 100);
        //armor
        if ($rand < 10) {
            $val = rand(1, 5) * $lvl;
            if ($item->stats->find(9) == null) {
               // $item->stats()->attach(9);
               // $item->stats()->updateExistingPivot(9, ['value' => $val]);
                $item->stats()->syncWithoutDetaching([9 =>['value' =>$val]]);
            } else {
                $item->stats()->updateExistingPivot(9, ['value' => $item->stats->find(9)->pivot->value + $val]);
            }
        }
        $rand = rand(1, 100);
        //health
        if ($rand < 25) {
            $val = rand(5, 20) * $lvl;
           // $item->stats()->attach(8);
           // $item->stats()->updateExistingPivot(8, ['value' => $val]);
            $item->stats()->syncWithoutDetaching([8 =>['value' =>$val]]);
        }
        //Adding bonuses from prefix
        if($prefix->stats != null) {
            foreach ($prefix->stats as $stat) {
                if ($item->stats->find($stat->id) == null) {
                    //$item->stats()->attach($stat->id);
                    // $item->stats()->updateExistingPivot($stat->id,['value' => $stat->pivot->value]);
                    $item->stats()->syncWithoutDetaching([$stat->id => ['value' => $stat->pivot->value]]);
                } else {
                    $item->stats()->updateExistingPivot($stat->id, ['value' => $item->stats->find($stat->id)->pivot->value + $stat->pivot->value]);
                }
            }
        }
        return $item;
    }

}
