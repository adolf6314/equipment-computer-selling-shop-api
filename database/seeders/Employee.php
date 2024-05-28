<?php

namespace Database\Seeders;

use App\Models\Employee as ModelsEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Employee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsEmployee::create([
            'id'=>'1',
            'firstname'=>'Adolf',
            'lastname'=>'Heater',
            'username'=>'AdolfHeat99',
            'email'=>'adolfheat@gmail.com',
            'password'=>Hash::make('123456'),
            'phone'=>'0123456789',
            'role'=>'0',
            'sex'=>'0',
            'work_status'=>'1',
            'status'=>'0',
            'address'=>'AdolfHeat City',
            'sub_dist_id'=>'0',
        ]);
    }
}
