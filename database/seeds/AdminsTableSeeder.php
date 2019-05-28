<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class)->create([
            'firstname' => 'Suleiman',
            'lastname' => 'Abdulrazaq',
            'role' => 'male',
            'block' => 'nhq',
            'email' => 'sman@gmail.com',
            'password' => Hash::make('@Suleimanu1')
        ]);
    }
}
