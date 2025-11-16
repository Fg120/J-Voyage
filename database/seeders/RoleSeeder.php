<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Role - Full Access
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Mitra Role - Limited Access
        $mitra = Role::create(['name' => 'mitra']);
        $mitra->givePermissionTo([
            'view_dashboard',
            'view_mitra_dashboard',
            'view_csr',
            'create_csr',
            'edit_csr',
            'view_reports',
        ]);

        // User Role - Basic Access
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view_dashboard',
            'view_csr',
        ]);
    }
}
