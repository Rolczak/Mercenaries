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
    }
}
