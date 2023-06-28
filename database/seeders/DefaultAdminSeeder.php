<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "password@123";

        $userData = [
            "full_name" => "Super Admin",
            "email" => "mantrac@gmail.com",
        ];

        $userData['password'] = Hash::make($password);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::select('name')
            ->where('name', RoleEnum::SUPER_ADMIN)->firstOrFail();
        $user = User::firstOrCreate(['email' => $userData['email']], $userData);

        $user->assignRole($superAdmin->name);
    }
}
