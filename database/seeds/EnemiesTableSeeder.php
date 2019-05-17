<?php

use Illuminate\Database\Seeder;

class EnemiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('enemies')->delete();
        
        \DB::table('enemies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Shooting Shield',
                'image_path' => '/img/enemies/shield.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Warlord from Africa',
                'image_path' => '/img/enemies/sławko.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Slavko',
                'image_path' => '/img/enemies/true_slavko.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}