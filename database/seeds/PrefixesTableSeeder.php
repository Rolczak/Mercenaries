<?php

use Illuminate\Database\Seeder;

class PrefixesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('prefixes')->delete();
        
        \DB::table('prefixes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Normal',
                'level' => '1',
                'color' => 'grey',
                'type' => 'weapon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Normal',
                'level' => '1',
                'color' => 'grey',
                'type' => 'armor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Good',
                'level' => '2',
                'color' => 'green',
                'type' => 'weapon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Strengthened',
                'level' => '3',
                'color' => 'green',
                'type' => 'armor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Accurate',
                'level' => '2',
                'color' => 'red',
                'type' => 'weapon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Good Looking',
                'level' => '2',
                'color' => 'green',
                'type' => 'armor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}