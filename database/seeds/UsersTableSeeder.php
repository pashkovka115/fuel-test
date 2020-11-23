<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            [
                'name' => 'Сергей Смирнов',
                'email' => 'pariss8@mail.ru',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => bcrypt('12345678'),
                'created_at' => now()
            ],
            [
                'name' => 'Горбуновa Алёна Сергеевна',
                'email' => 'alena@mail.com',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(),
                'password' => bcrypt('12345678'),
                'created_at' => now()
            ],
        ];


        DB::table('users')->insert($users);
    }

}
