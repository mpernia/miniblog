<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Traits;

use MiniBlog\BoundedContext\Frontend\Application\Actions\Category\CategoryBreadcrumbMaker;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Category\CategoryLister;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Tag\TagScorer;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

trait SectionLoader
{
    public static function loadSections(?int $categoryId = null) : DataTransferObject
    {
        $categories = CategoryLister::list();
        $tags = TagScorer::score();
        $breadcrumbs = is_null($categories) ? [] : CategoryBreadcrumbMaker::make((int)$categoryId);

        return new DataTransferObject([
            'categories' => $categories,
            'tags' => $tags,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
