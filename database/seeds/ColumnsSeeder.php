<?php

use Illuminate\Database\Seeder;

class ColumnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $columns = [
            [
                'column' => '№ 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'column' => '№ 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'column' => '№ 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Column::insert($columns);
    }
}
