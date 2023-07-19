<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\Tests\BaseTestCase;
use MiniBlog\Tests\Factories\PostFactory;

class PostUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_post_creator_successful()
    {
        $post = PostFactory::create();
        PostCreator::create($post);
        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'content' => $post->content,
            'excerpt' => $post->excerpt,
        ]);
    }

    public function test_post_creator_returns_error()
    {
        $this->expectException(QueryException::class);
        PostCreator::create(new PostDto([]));
        $this->expectExceptionCode(23000);
    }

    public function test_post_updater_successful()
    {
        $currentPost = PostCreator::create(PostFactory::create());
        $newPost = PostUpdater::update(PostFactory::create(), $currentPost->id);
        $this->assertEquals($currentPost->id, $newPost->id);
        $this->assertDatabaseHas('posts', [
            'title' => $newPost->title,
            'content' => $newPost->content,
            'excerpt' => $newPost->excerpt,
        ]);
    }

    public function test_post_updater_returns_error()
    {
        $this->expectException(QueryException::class);
        $post = PostCreator::create(PostFactory::create());
        PostUpdater::update(new PostDto([]), $post->id);
        $this->expectExceptionCode(23000);
    }

    public function test_post_destroyer_successful()
    {
        $post = PostCreator::create(PostFactory::create());
        PostDestroyer::destroy($post->id);
        $this->assertSoftDeleted('posts', $post->toArray());
    }

    public function test_post_destroyer_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        PostDestroyer::destroy(9999);
    }

    public function test_post_finder_all()
    {
        $categories = PostFactory::create(5);
        foreach ($categories as $category) {
            PostCreator::create($category);
        }
        $result = PostFinder::all();
        $this->assertNotEmpty($result);
    }

    public function test_post_finder_successful()
    {
        $list = [];
        $posts = PostFactory::create(5);
        foreach ($posts as $post) {
            $list[] = PostCreator::create($post);
        }
        $target = $list[rand(1, 5)];
        $this->assertEquals($target, PostFinder::find($target->id));
    }

    public function test_post_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        PostFinder::find(9999);
    }
}
