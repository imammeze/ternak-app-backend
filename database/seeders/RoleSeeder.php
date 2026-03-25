<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin       = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $roleManager     = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $roleStakeholder = Role::firstOrCreate(['name' => 'stakeholder', 'guard_name' => 'web']);
        $roleKaryawan    = Role::firstOrCreate(['name' => 'karyawan', 'guard_name' => 'web']);

        $permissions = [
            'akses menu input data',
            'akses menu produksi susu',
            'akses menu data ternak',
            'akses menu user management',
            'akses menu report finansial',
            'akses menu absen',
            'akses menu pengumuman'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $roleAdmin->syncPermissions([
            'akses menu input data',
            'akses menu produksi susu',
            'akses menu data ternak',
            'akses menu user management'
        ]);

        $roleManager->syncPermissions([
            'akses menu input data',
            'akses menu produksi susu',
            'akses menu data ternak'
        ]);

        $roleStakeholder->syncPermissions([
            'akses menu report finansial',
            'akses menu produksi susu',
            'akses menu data ternak'
        ]);

        $roleKaryawan->syncPermissions([
            'akses menu input data',
            'akses menu absen',
            'akses menu pengumuman'
        ]);
    }
}