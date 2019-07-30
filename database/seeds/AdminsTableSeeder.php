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
                'username' => 'sman',
                'email' => 'sman@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'male',
                'block' => 'hq',
                'office' => 'admin',
                'role' => 1,
            ],
            [
                'firstname' => 'Usman',
                'lastname' => 'Shuaib',
                'username' => 'usman',
                'email' => 'usman@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'male',
                'block' => 'hq',
                'office' => 'gate',
                'role' => 2,
            ],
            [
                'firstname' => 'Hauwa',
                'lastname' => 'Abdallah',
                'username' => 'hauwie',
                'email' => 'hauwie@gmail.com',
                'password' => Hash::make('12345678'),
                'gender' => 'female',
                'block' => 'hq',
                'office' => 'reception',
                'role' => 3,
            ]
        ];
    
        foreach($admins as $admin){
            Admin::create($admin);
        }
    }
}
