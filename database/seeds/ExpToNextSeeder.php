<?php

use Illuminate\Database\Seeder;

class ExpToNext extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exp = new App\ExpToNext();
        $exp->experience = 10;
        $exp->save();

        $exp = new App\ExpToNext();
        $exp->experience = 25;
        $exp->save();
    }
}
