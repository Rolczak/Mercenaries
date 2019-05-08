<?php

use App\Stat;
use Illuminate\Database\Seeder;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stat::create([
            'name' => 'strength',
        ]);
        Stat::create([
            'name' => 'accuracy',
        ]);
        Stat::create([
            'name' => 'bargaining',
        ]);

        Stat::create([
            'name' => 'currHp',
        ]);

        Stat::create([
            'name'=> 'weapon',
        ]);

        Stat::create([
            'name' => 'armor',
        ]);

        Stat::create([
            'name'=> 'damage',
        ]);

        Stat::create([
            'name'=>'health',
        ]);

        Stat::create([
            'name'=>'defense',
        ]);

        Stat::create([
            'name'=>'experience',
        ]);

        Stat::create([
           'name' => 'level',
        ]);
    }
}
