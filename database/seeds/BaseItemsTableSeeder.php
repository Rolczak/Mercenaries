<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BaseItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_items')->delete();
        
        \DB::table('base_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Machete',
                'type' => 'weapon',
                'image_path' => '/img/weapons/basic.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'T-Shirt',
                'type' => 'armor',
                'image_path' => '/img/armors/basic.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'M4',
                'type' => 'weapon',
                'image_path' => '/img/weapons/M4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'AKM',
                'type' => 'weapon',
                'image_path' => '/img/weapons/AKM.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Revolver',
                'type' => 'weapon',
                'image_path' => '/img/weapons/revolver.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pistol',
                'type' => 'weapon',
                'image_path' => '/img/weapons/pistol.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Leather Jacket',
                'type' => 'armor',
                'image_path' => '/img/armors/jacket.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Military Uniform',
                'type' => 'armor',
                'image_path' => '/img/armors/camo.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Plate Vest Carrier',
                'type' => 'armor',
                'image_path' => '/img/armors/plate_vest.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Tactical Vest',
                'type' => 'armor',
                'image_path' => '/img/armors/tactical_vest.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
        
        
    }
}