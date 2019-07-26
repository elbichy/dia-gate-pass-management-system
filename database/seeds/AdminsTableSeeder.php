<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Illuminate\Support\Facades\DB;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'firstname' => 'Suleiman',
                'lastname' => 'Abdulrazaq',
                'email' => 'sman@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'male',
                'block' => 'hq',
                'role' => 1,
            ],
            [
                'firstname' => 'Usman',
                'lastname' => 'Shuaib',
                'email' => 'usman@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'male',
                'block' => 'hq',
                'role' => 2,
            ],
            [
                'firstname' => 'Hauwa',
                'lastname' => 'Abdallah',
                'email' => 'hauwie@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'female',
                'block' => 'hq',
                'role' => 3,
            ]
        ];
    
        foreach($admins as $admin){
            Admin::create($admin);
        }
    }
}
