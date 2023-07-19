<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'title' => 'user_management_access', 'description' => 'Full Management Access'],
            ['id' => 2, 'title' => 'permission_store', 'description' => 'Permission Store'],
            ['id' => 3, 'title' => 'permission_update', 'description' => 'Permission Update'],
            ['id' => 4, 'title' => 'permission_show', 'description' => 'Permission Show'],
            ['id' => 5, 'title' => 'permission_delete', 'description' => 'Permission Delete'],
            ['id' => 6, 'title' => 'permission_access', 'description' => 'Permission Access'],
            ['id' => 7, 'title' => 'role_store', 'description' => 'Role Store'],
            ['id' => 8, 'title' => 'role_update', 'description' => 'Role Update'],
            ['id' => 9, 'title' => 'role_show', 'description' => 'Role Show'],
            ['id' => 10, 'title' => 'role_delete', 'description' => 'Role Delete'],
            ['id' => 11, 'title' => 'role_access', 'description' => 'Role Access'],
            ['id' => 12, 'title' => 'user_store', 'description' => 'User Store'],
            ['id' => 13, 'title' => 'user_update', 'description' => 'User Update'],
            ['id' => 14, 'title' => 'user_show', 'description' => 'User Show'],
            ['id' => 15, 'title' => 'user_delete', 'description' => 'User Delete'],
            ['id' => 16, 'title' => 'user_access', 'description' => 'User Access'],
            ['id' => 17, 'title' => 'category_store', 'description' => 'Category Store'],
            ['id' => 18, 'title' => 'category_update', 'description' => 'Category Update'],
            ['id' => 19, 'title' => 'category_show', 'description' => 'Category Show'],
            ['id' => 20, 'title' => 'category_delete', 'description' => 'Category Delete'],
            ['id' => 21, 'title' => 'category_access', 'description' => 'Category Access'],
            ['id' => 22, 'title' => 'tag_store', 'description' => 'Tag Store'],
            ['id' => 23, 'title' => 'tag_update', 'description' => 'Tag Update'],
            ['id' => 24, 'title' => 'tag_show', 'description' => 'Tag Show'],
            ['id' => 25, 'title' => 'tag_delete', 'description' => 'Tag Delete'],
            ['id' => 26, 'title' => 'tag_access', 'description' => 'Tag Access'],
            ['id' => 27, 'title' => 'post_store', 'description' => 'Post Store'],
            ['id' => 28, 'title' => 'post_update', 'description' => 'Post Update'],
            ['id' => 29, 'title' => 'post_show', 'description' => 'Post Show'],
            ['id' => 30, 'title' => 'post_delete', 'description' => 'Post Delete'],
            ['id' => 31, 'title' => 'post_access', 'description' => 'Post Access'],
        ];
        Permission::insert($permissions);
    }
}

