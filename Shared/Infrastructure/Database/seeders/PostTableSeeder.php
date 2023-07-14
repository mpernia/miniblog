<?php

namespace MiniBlog\Shared\Infrastructure\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'excerpt' => null,
            ],
            [
                'id' => 2,
                'title' => 'lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'excerpt' => null,
            ],
            [
                'id' => 3,
                'title' => 'lorem Ipsum',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'excerpt' => null,
            ],
        ];

        Post::insert($posts);
        DB::table('category_post')->insert([
            ['post_id' => 1, 'category_id' => 1],
            ['post_id' => 2, 'category_id' => 1],
            ['post_id' => 3, 'category_id' => 1]
        ]);

        DB::table('post_tag')->insert([
            ['post_id' => 1, 'tag_id' => 1],
            ['post_id' => 2, 'tag_id' => 2],
            ['post_id' => 3, 'tag_id' => 3],
        ]);
    }
}
