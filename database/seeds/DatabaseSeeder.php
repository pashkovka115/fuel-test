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
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(FuelSeeder::class);
        $this->call(ColumnsSeeder::class);
        $this->call(ColumnHasFuelSeeder::class);
    }
}
