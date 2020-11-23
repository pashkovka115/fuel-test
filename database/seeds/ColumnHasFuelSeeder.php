<?php

use Illuminate\Database\Seeder;

class ColumnHasFuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rels = [
            [
                'fuel_id' => 1,
                'column_id' => 1
            ],
            [
                'fuel_id' => 2,
                'column_id' => 2
            ],
            [
                'fuel_id' => 3,
                'column_id' => 2
            ],
            [
                'fuel_id' => 4,
                'column_id' => 3
            ],
            [
                'fuel_id' => 5,
                'column_id' => 3
            ],
        ];

        DB::table('column_has_fuel')->insert($rels);
    }
}
