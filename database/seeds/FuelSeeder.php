<?php

use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuels = [
            [
                'fuel' => 'Бензин',
                'code' => '92',
                'volume' => 1000000,
                'price' => 39.45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fuel' => 'Бензин',
                'code' => '95',
                'volume' => 1000000,
                'price' => 45.44,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fuel' => 'Бензин',
                'code' => '98',
                'volume' => 1000000,
                'price' => 53.35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fuel' => 'Дизель',
                'code' => 'летнее ДТ',
                'volume' => 1000000,
                'price' => 51.67,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fuel' => 'Дизель',
                'code' => 'зимнее ДТ',
                'volume' => 1000000,
                'price' => 52.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Fuel::insert($fuels);
    }
}

