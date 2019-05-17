<?php

use Illuminate\Database\Seeder;

class EnemyStatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('enemy_stat')->delete();
        
        \DB::table('enemy_stat')->insert(array (
            0 => 
            array (
                'stat_id' => 1,
                'enemy_id' => 1,
                'value' => 1,
            ),
            1 => 
            array (
                'stat_id' => 1,
                'enemy_id' => 2,
                'value' => 5,
            ),
            2 => 
            array (
                'stat_id' => 1,
                'enemy_id' => 3,
                'value' => 13,
            ),
            3 => 
            array (
                'stat_id' => 2,
                'enemy_id' => 1,
                'value' => 1,
            ),
            4 => 
            array (
                'stat_id' => 2,
                'enemy_id' => 2,
                'value' => 8,
            ),
            5 => 
            array (
                'stat_id' => 2,
                'enemy_id' => 3,
                'value' => 15,
            ),
            6 => 
            array (
                'stat_id' => 4,
                'enemy_id' => 1,
                'value' => 20,
            ),
            7 => 
            array (
                'stat_id' => 4,
                'enemy_id' => 2,
                'value' => 250,
            ),
            8 => 
            array (
                'stat_id' => 4,
                'enemy_id' => 3,
                'value' => 300,
            ),
            9 => 
            array (
                'stat_id' => 7,
                'enemy_id' => 1,
                'value' => 1,
            ),
            10 => 
            array (
                'stat_id' => 7,
                'enemy_id' => 2,
                'value' => 10,
            ),
            11 => 
            array (
                'stat_id' => 7,
                'enemy_id' => 3,
                'value' => 15,
            ),
            12 => 
            array (
                'stat_id' => 9,
                'enemy_id' => 1,
                'value' => 1,
            ),
            13 => 
            array (
                'stat_id' => 9,
                'enemy_id' => 2,
                'value' => 10,
            ),
            14 => 
            array (
                'stat_id' => 9,
                'enemy_id' => 3,
                'value' => 8,
            ),
        ));
        
        
    }
}