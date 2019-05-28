<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'firstname' => 'Ibrahim',
            'lastname' => 'Abdullahi',
            'block' => 'nhq',
            'email' => 'above@gmail.com',
            'password' => Hash::make('letgothere'),
        ]);
    }
}
