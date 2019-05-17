<?php

use App\ExpToNext;
use Illuminate\Database\Seeder;

class ExpToNextTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpToNext::create([
            'experience' => 0,
        ]);
        ExpToNext::create([
            'experience' => 10,
        ]);
        ExpToNext::create([
            'experience' => 50,
        ]);
        ExpToNext::create([
            'experience' => 120,
        ]);
        ExpToNext::create([
            'experience' => 380,
        ]);
        ExpToNext::create([
            'experience' => 780,
        ]);
        ExpToNext::create([
            'experience' => 9999,
        ]);
    }
}
