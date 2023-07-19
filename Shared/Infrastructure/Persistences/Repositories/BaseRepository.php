<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Repositories;

use MiniBlog\Shared\Infrastructure\Exceptions\UndefinedMethodException;

abstract class BaseRepository extends EloquentRepository
{
    abstract public function setModel() : string;

    public function __construct()
    {
        if (!method_exists($this, 'setModel')) {
            throw new UndefinedMethodException('setModel', $this);
        }
        parent::__construct();
    }
}
