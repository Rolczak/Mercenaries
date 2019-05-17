<?php

namespace App\Http\Controllers;

use App\Item;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shop = Shop::find(request()->user()->id);
        if((Carbon::parse($shop->update_time)->diffInHours(Carbon::now()) > 8) || $shop->items->first() == null)
        {
            $shop->generateItemsForShop(request()->user());
        }
        $items = $shop->items;
        $userItems = request()->user()->getAllItems();
        return view('shop',compact('items', 'userItems'));
    }

    public function buyItem()
    {
       $user = request()->user();
       $item = Item::find(request()->item);
       $shop = Shop::find($user->id);
       if($user->credits < $item->price)
       {
           return redirect()->back()->with('errTitle','Error')->with('err', 'You don\'t have enough credits');
       }

       $user->items()->attach($item->id);
       $user->credits -= $item->price;
       $user->save();
       $shop->items()->detach($item->id);
       return redirect()->back()->with('modTitle','Item bought')->with('mod', 'You bought '.$item->name);
    }

    public function sellItem()
    {
        $user = request()->user();
        $item = Item::find(request()->item);

        $user->items()->detach($item->id);
        $user->credits += $item->price;
        $user->save();
        return redirect()->back()->with('modTitle','Item sold')->with('mod', 'You sold '.$item->name);
    }

}

