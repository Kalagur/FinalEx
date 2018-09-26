<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Джек',
            'balance' => 5000,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Дэн',
            'balance' => 50000,
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Генри',
            'balance' => 0,
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Уильям',
            'balance' => 1000,
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Бартоломью',
            'balance' => 100000,
        ]);
    }
}
