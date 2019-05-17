<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(StatTableSeeder::class);
        $this->call(ExpToNextTableSeeder::class);
        $this->call(BaseItemsTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(EnemiesTableSeeder::class);
        $this->call(ContractEnemyTableSeeder::class);
        $this->call(EnemyStatTableSeeder::class);
        $this->call(LogsTableSeeder::class);
        $this->call(PrefixesTableSeeder::class);
        $this->call(PrefixStatTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ItemStatTableSeeder::class);
    }
}
