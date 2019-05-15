<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGenerator extends Model
{
    public function generateItem($lvl)
    {
        $base = BaseItem::all()->random();
        $prefix = Prefix::all()->where('level', '>', $lvl - 2)->where('level', '<', $lvl + 2)->random();
        $item = new Item;
        $item->name = $prefix->name.' '.$base->name;
        $item->color = $prefix->color;
        $item->base_item_id = $base->id;

        if($base->type == 'weapon')
        {

        }
        else if($base->type == 'armor')
        {

        }
    }
}
