<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GivePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // give permission to admin
        $admin = User::where('email', 'test@example.com')->first();
        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::create(['name' => 'All Permission']);

        $role->givePermissionTo($permissions);
        $admin->syncRoles($role);
    }
}
