<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::select('id')->whereNull('deleted_at')->get()->toArray();
        $permissions = Permission::select('id')->whereNull('deleted_at')->get()->toArray();

        RolePermission::insert([
            [
                'role_id' => $roles[0]['id'],
                'permission_id' => $permissions[0]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $roles[0]['id'],
                'permission_id' => $permissions[1]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $roles[0]['id'],
                'permission_id' => $permissions[2]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $roles[1]['id'],
                'permission_id' => $permissions[1]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
