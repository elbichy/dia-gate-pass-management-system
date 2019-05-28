<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'firstname' => 'Suleiman',
        'lastname' => 'Abdulrazaq',
        'gender' => 'male',
        'block' => 'hq',
        'email' => 'sman@gmail.com',
        'password' => Hash::make('12345678'),
        'role' => 1,
    ];
});
