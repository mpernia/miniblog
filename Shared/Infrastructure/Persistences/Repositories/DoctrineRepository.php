<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Repositories;

use MiniBlog\Shared\Domain\Contracts\RepositoryInterface;

abstract class DoctrineRepository implements RepositoryInterface
{
    abstract public function setModel() : string;

    public static function sqlRaw(string $sql, array $params = []): array
    {
        // TODO: Implement sqlRaw() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    public function findWhere($column, $value)
    {
        // TODO: Implement findWhere() method.
    }

    public function findWhereFirst($column, $value)
    {
        // TODO: Implement findWhereFirst() method.
    }

    public function paginate(int $perPage = 10)
    {
        // TODO: Implement paginate() method.
    }

    public function with(array $data)
    {
        // TODO: Implement with() method.
    }

    public function load(array $data)
    {
        // TODO: Implement load() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
