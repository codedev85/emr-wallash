<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //
        //    factory(User::class)->create();
        User::create([
            'name' => 'Administrtor',
            'last_name'=> 'Administrator',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => Hash::make('secret@'),
            'address'       => 'Lagos Nigeria',
            'phone_number'  => '08109403277',
        ]);
    }
}



