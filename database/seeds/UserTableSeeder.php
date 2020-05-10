<?php

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
        //
        factory(\App\User::class,200)->create();
          // User::create([
        //     'name'              => $faker->name,
        //     'email'             => $faker->email,,
        //     'email_verified_at' => now(),
        //     'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token'    => Str::random(10),
        //     'role_id'           => function(){
        //                         return  App\User::all()->random();
        //                         },
        //     'address'           => $faker->address,
        //     'phone_number'      =>$faker->phoneNumber,
        // ]);
    }
}


