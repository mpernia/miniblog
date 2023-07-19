<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\Tests\BaseTestCase;
use MiniBlog\Tests\Factories\TagFactory;

class TagUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_tag_creator_successful()
    {
        $tag = TagFactory::create();
        TagCreator::create($tag);
        $this->assertDatabaseHas('tags', [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ]);
    }

    public function test_tag_creator_returns_error()
    {
        $this->expectException(QueryException::class);
        TagCreator::create(new TagDto([]));
        $this->expectExceptionCode(23000);
    }

    public function test_tag_updater_successful()
    {
        $currentTag = TagCreator::create(TagFactory::create());
        $newTag = TagUpdater::update(TagFactory::create(), $currentTag->id);
        $this->assertEquals($currentTag->id, $newTag->id);
        $this->assertDatabaseHas('tags', [
            'name' => $newTag->name,
            'slug' => $newTag->slug,
        ]);
    }

    public function test_tag_updater_returns_error()
    {
        $this->expectException(QueryException::class);
        $tag = TagCreator::create(TagFactory::create());
        TagUpdater::update(new TagDto([]), $tag->id);
        $this->expectExceptionCode(23000);
    }

    public function test_tag_destroyer_successful()
    {
        $tag = TagCreator::create(TagFactory::create());
        TagDestroyer::destroy($tag->id);
        $this->assertSoftDeleted('tags', $tag->toArray());
    }

    public function test_tag_destroyer_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        TagDestroyer::destroy(9999);
    }

    public function test_tag_finder_all()
    {
        $tags = TagFactory::create(5);
        foreach ($tags as $tag) {
            TagCreator::create($tag);
        }
        $result = TagFinder::all();
        $this->assertNotEmpty($result);
    }

    public function test_tag_finder_successful()
    {
        $list = [];
        $tags = TagFactory::create(5);
        foreach ($tags as $tag) {
            $list[] = TagCreator::create($tag);
        }
        $target = $list[rand(1, 5)];
        $this->assertEquals($target, TagFinder::find($target->id));
    }

    public function test_tag_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        TagFinder::find(9999);
    }
}
