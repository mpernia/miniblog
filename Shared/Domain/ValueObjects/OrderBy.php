<?php

namespace MiniBlog\Shared\Domain\ValueObjects;

enum OrderBy: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';
}
