<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'base_item_id' => 1,
            'name' => 'Old Machete',
            'color' => 'grey',
            'price' => 1,
        ]);

        Item::create([
            'base_item_id' => 2,
            'name' => 'Worn T-Shirt',
            'color' => 'grey',
            'price' => 1,
        ]);
    }
}
