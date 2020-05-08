<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        

        'name'         => $faker->word(),
        'email'        => 'admin@admin.com',
        'password'     => Hash::make($data['password']),, // password
        'role_id'      => function(){
                            return App\Role::all()->random();
                           },
        'address'       => $faker->address(),
        'phone_number'  => $faker->phoneNumber(),
    ];
});









