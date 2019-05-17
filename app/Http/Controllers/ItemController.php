<?php

namespace App\Http\Controllers;

use App\BaseItem;
use App\ItemGenerator;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = BaseItem::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        BaseItem::create($request->all());
        return $this->index();
    }

    public function edit($id)
    {
        $item= BaseItem::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = BaseItem::findOrFail($id);
        $item->name = $request->name;
        $item->image_path = $request->image_path;
        $item->type = $request->type;
        $item->save();
        return $this->index();
    }

    public function destroy($id)
    {
        $item = BaseItem::findOrFail($id);
        $item->delete();
        return $this->index();
    }

    public function generate()
    {
        return ItemGenerator::generateItem(request()->lvl);
    }

}
