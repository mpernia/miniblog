<?php

namespace MiniBlog\Tests\Unit;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;

use MiniBlog\Tests\BaseTestCase;
use MiniBlog\Tests\Factories\CategoryFactory;

class CategoryUnitTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_category_creator_successful()
    {
        $category = CategoryFactory::create();
        CategoryCreator::create($category);
        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
    }

    public function test_category_creator_returns_error()
    {
        $this->expectException(QueryException::class);
        CategoryCreator::create(new CategoryDto([]));
        $this->expectExceptionCode(23000);
    }

    public function test_category_updater_successful()
    {
        $currentCategory = CategoryCreator::create(CategoryFactory::create());
        $newCategory = CategoryUpdater::update(CategoryFactory::create(), $currentCategory->id);
        $this->assertEquals($currentCategory->id, $newCategory->id);
        $this->assertDatabaseHas('categories', [
            'name' => $newCategory->name,
            'slug' => $newCategory->slug,
        ]);
    }

    public function test_category_updater_returns_error()
    {
        $this->expectException(QueryException::class);
        $category = CategoryCreator::create(CategoryFactory::create());
        CategoryUpdater::update(new CategoryDto([]), $category->id);
        $this->expectExceptionCode(23000);
    }

    public function test_category_destroyer_successful()
    {
        $category = CategoryCreator::create(CategoryFactory::create());
        CategoryDestroyer::destroy($category->id);
        $this->assertSoftDeleted('categories', $category->toArray());
    }

    public function test_category_destroyer_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        CategoryDestroyer::destroy(9999);
    }

    public function test_category_finder_all()
    {
        $categories = CategoryFactory::create(5);
        foreach ($categories as $category) {
            CategoryCreator::create($category);
        }
        $result = CategoryFinder::all();
        $this->assertNotEmpty($result);
    }

    public function test_category_finder_successful()
    {
        $list = [];
        $categories = CategoryFactory::create(5);
        foreach ($categories as $category) {
            $list[] = CategoryCreator::create($category);
        }
        $target = $list[rand(1, 5)];
        $this->assertEquals($target, CategoryFinder::find($target->id));
    }

    public function test_category_finder_returns_error()
    {
        $this->expectException(ModelNotFoundException::class);
        CategoryFinder::find(9999);
    }
}
