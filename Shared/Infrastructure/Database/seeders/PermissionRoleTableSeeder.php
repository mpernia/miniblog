<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Permission;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
