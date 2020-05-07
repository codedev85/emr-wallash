<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'role_id' => 1,
        'state'  => $faker->numberBetween(1,5),
        'lga'  => $faker->numberBetween(1,5),
        'unique_id' => $faker->numberBetween(1000,9999),
        'address' => $faker->address,
        'phone_number'=>$faker->phoneNumber,
        'occupation' => $faker->word,
        'gender'    => $faker->word,
        'dob'      => $faker->dateTime($max = 'now', $timezone = null),
        'marital_status' => 'Married',
        'allergies'  => $faker->sentence,
        'genotype'  => 'O-',
        'bloodgroup'=> 'AA',  

        // 'name' => $faker->name,
        // 'email' => 'admin@gmail.com',
        // 'email_verified_at' => now(),
        // 'password' => Hash::make($data['password']),, // password
        // 'remember_token' => Str::random(10),
        // 'role_id' => 1,
        // 'state'  => $faker->numberBetween(1,5),
        // 'lga'  => $faker->numberBetween(1,5),
        // 'unique_id' => $faker->numberBetween(1000,9999),
        // 'address' => $faker->address,
        // 'phone_number'=>$faker->phoneNumber,
        // 'occupation' => $faker->word,
        // 'gender'    => $faker->word,
        // 'dob'      => $faker->dateTime($max = 'now', $timezone = null),
        // 'marital_status' => 'Married',
        // 'allergies'  => $faker->sentence,
        // 'genotype'  => 'O-',
        // 'bloodgroup'=> 'AA', 
    ];
    
});
