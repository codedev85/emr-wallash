<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
           ]);
   
        Role::create([
            'name' => 'Doctor',
        ]);
   
        Role::create([
            'name' => 'Nurs',
         ]);

        Role::create([
            'name' => 'Pharmacist',
        ]);

        Role::create([
        'name' => 'Receptionist',
        ]);

        Role::create([
        'name' => 'Patient',
        ]);
    }
}
