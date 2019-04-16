<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Rolczak';
        $user->email = 'kc.rolczak@gmail.com';
        $user->password = bcrypt('tarantula');
        $user->role_id = 2;
        $user->save();

    }
}
