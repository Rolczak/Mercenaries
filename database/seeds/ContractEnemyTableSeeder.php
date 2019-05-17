<?php

use Illuminate\Database\Seeder;

class ContractEnemyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contract_enemy')->delete();
        
        \DB::table('contract_enemy')->insert(array (
            0 => 
            array (
                'contract_id' => 1,
                'enemy_id' => 1,
            ),
            1 => 
            array (
                'contract_id' => 2,
                'enemy_id' => 2,
            ),
            2 => 
            array (
                'contract_id' => 2,
                'enemy_id' => 3,
            ),
        ));
        
        
    }
}