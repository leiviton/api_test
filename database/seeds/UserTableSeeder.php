<?php

use TestPax\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
            [
                'name' => 'Leiviton Carlos',
                'email' => 'leivitoncs@gmail.com',
                'role' => 'admin',
                'password' => bcrypt(123456),
                'remember_token' => md5(10) // str_random(10),
            ]);

    }
}
