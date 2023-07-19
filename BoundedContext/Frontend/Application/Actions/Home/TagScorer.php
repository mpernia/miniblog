<?php

namespace MiniBlog\BoundedContext\Frontend\Application\Actions\Home;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;
use MiniBlog\Shared\Domain\ValueObjects\OrderBy;


class TagScorer
{
    public static function score(OrderBy $sort = OrderBy::DESC) : array
    {
        return TagRepository::sqlRaw("
            SELECT
                tags.id, tags.name, ((COUNT(post_tag.tag_id) * 2)+12) AS score
            FROM tags
                INNER JOIN post_tag ON post_tag.tag_id = tags.id
            WHERE tags.deleted_at IS NULL
            GROUP BY tags.id
            ORDER BY score {$sort->value}
            LIMIT 50;
        ");
    }
}
