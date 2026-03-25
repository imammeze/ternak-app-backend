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
        
        $admin->assignRole('admin');
    }
}