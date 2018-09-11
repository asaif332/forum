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
        App\User :: create([
            'name' => 'rehan ansari',
            'email' => 'asaif793@gmail.com',
            'password' => bcrypt('password'),
            'admin' => 1,
            'avatar' => asset('avatars/user.png')
        ]);

        App\User :: create([
            'name' => 'sahil ansari',
            'email' => 'asaif33298@gmail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('avatars/user.png')
        ]);
    }
}
