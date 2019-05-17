<?php

use Illuminate\Database\Seeder;

class PrefixStatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('prefix_stat')->delete();
        
        \DB::table('prefix_stat')->insert(array (
            0 => 
            array (
                'stat_id' => 1,
                'prefix_id' => 3,
                'value' => 1,
            ),
            1 => 
            array (
                'stat_id' => 2,
                'prefix_id' => 5,
                'value' => 7,
            ),
            2 => 
            array (
                'stat_id' => 3,
                'prefix_id' => 6,
                'value' => 4,
            ),
            3 => 
            array (
                'stat_id' => 7,
                'prefix_id' => 3,
                'value' => 2,
            ),
            4 => 
            array (
                'stat_id' => 7,
                'prefix_id' => 5,
                'value' => 1,
            ),
            5 => 
            array (
                'stat_id' => 8,
                'prefix_id' => 4,
                'value' => 30,
            ),
            6 => 
            array (
                'stat_id' => 9,
                'prefix_id' => 4,
                'value' => 5,
            ),
            7 => 
            array (
                'stat_id' => 9,
                'prefix_id' => 6,
                'value' => 4,
            ),
        ));
        
        
    }
}