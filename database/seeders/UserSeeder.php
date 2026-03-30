<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@peternakan.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin1234'), 
            ]
        );

        $manager = User::firstOrCreate(
            ['email' => 'manager@peternakan.com'],
            [
                'name' => 'Manager',
                'password' => Hash::make('manager1234'), 
            ]
        );

        $stakeholder = User::firstOrCreate(
            ['email' => 'stakeholder@peternakan.com'],
            [
                'name' => 'Stakeholder',
                'password' => Hash::make('stakeholder1234'), 
            ]
        );

         $karyawan = User::firstOrCreate(
            ['email' => 'karyawan@peternakan.com'],
            [
                'name' => 'Karyawan',
                'password' => Hash::make('karyawan1234'), 
            ]
        );
        
        $admin->assignRole('admin');
        $manager->assignRole('manager');
        $stakeholder->assignRole('stakeholder');
        $karyawan->assignRole('karyawan');
    }
}