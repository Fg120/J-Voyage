<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==================== PERMISSIONS ====================
        $this->createPermissions();

        // ==================== ROLES ====================
        $roles = $this->createRoles();

        // ==================== USERS ====================
        $this->createUsers($roles);
    }

    /**
     * Create all permissions
     */
    private function createPermissions(): void
    {
        $permissions = [
            // User Management
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'restore_users',
            'force_delete_users',

            // Role Management
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            // Dashboard
            'view_dashboard',
            'view_admin_dashboard',
            'view_mitra_dashboard',

            // CSR/Mitra Management
            'view_csr',
            'create_csr',
            'edit_csr',
            'delete_csr',
            'approve_csr',
            'reject_csr',

            // Reports
            'view_reports',
            'export_reports',

            // Settings
            'view_settings',
            'edit_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    /**
     * Create roles and assign permissions
     */
    private function createRoles(): array
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

        return compact('admin', 'mitra', 'user');
    }

    /**
     * Create default users with roles
     */
    private function createUsers(array $roles): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ],
            [
                'name' => 'Mitra User',
                'email' => 'mitra@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'mitra',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'user',
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            $user = User::create($userData);
            $user->assignRole($role);
        }
    }
}
