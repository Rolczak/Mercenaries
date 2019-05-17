<?php

use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('logs')->delete();
        
        \DB::table('logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Version 0.0.2',
                'content' => 'Complete rework of many systems and look.',

                'created_at' => '2019-05-20 21:53:22',
                'updated_at' => '2019-05-20 21:53:22',
            ),
        ));
        
        
    }
}