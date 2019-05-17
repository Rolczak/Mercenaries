<?php

use Illuminate\Database\Seeder;

class ItemStatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('item_stat')->insert(array (
            0 =>
                array (
                    'stat_id' => 2,
                    'item_id' => 1,
                    'value' => 2,
                ),
            1 =>
                array (
                    'stat_id' => 7,
                    'item_id' => 1,
                    'value' => 3,
                ),
            2 =>
                array (
                    'stat_id' => 1,
                    'item_id' => 2,
                    'value' => 2,
                ),
            3 =>
                array (
                    'stat_id' => 8,
                    'item_id' => 2,
                    'value' => 10,
                ),
            4 =>
                array (
                    'stat_id' => 9,
                    'item_id' => 2,
                    'value' => 2,
                ),

        ));
    }
}
