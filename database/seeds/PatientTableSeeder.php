<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'John',
            'last_name'=> 'Doe',
            'email' => 'patient@patient.com',
            'role_id' => 6,
            'password' => Hash::make('password'),
            'address'       => 'Lagos Nigeria',
            'phone_number'  => '08109403277',
        ]);
    }
}
