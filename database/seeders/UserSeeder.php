<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::select('id')->whereNull('deleted_at')->get()->toArray();

        User::create([
            'name' => 'admin',
            'email' => 'admin@ecomlite.com',
            'role_id' => $roles[0]['id'],
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'admin 2',
            'email' => 'admin2@ecomlite.com',
            'role_id' => $roles[0]['id'],
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'admin 3',
            'email' => 'admin3@ecomlite.com',
            'role_id' => $roles[0]['id'],
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
        ]);
    }
}
