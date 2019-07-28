<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'User App',
            'email'     => 'app@test.com',
            'password'  => bcrypt('123'),
            'token' => hash('sha256', Str::random(60)),
        ]);
    }
}
