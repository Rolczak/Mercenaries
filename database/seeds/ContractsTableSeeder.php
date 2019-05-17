<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContractsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contracts')->delete();
        
        \DB::table('contracts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Train On Shooting range',
                'description' => 'Training is key to be great mercenary.',
                'time' => 3.0,
                'energy' => 20.0,
                'image_path' => '/img/contracts/range.png',
                'min_level' => 1,
                'credits' => 150,
                'exp' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Your first mission',
                'description' => 'You are assigned to defeat african warlord named Slavko. Warlord have wife and ten childrens. About week ago he break into our warehouse with bath water and stole bucket of water to give to drink his family. We cannot allowed for this kind of crimes. Do it as fast as possible.',
                'time' => 15.0,
                'energy' => 20.0,
                'image_path' => '/img/contracts/sławko.png',
                'min_level' => 2,
                'credits' => 500,
                'exp' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
        
        
    }
}