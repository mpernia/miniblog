<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface RepositoryInterface
{
    public static function sqlRaw(string $query): array;

    public function setRouteKeyName(string $name) : void;

    public function sync(int|string $id, array $ids, string $related, string $relatedKey, string $foreignKey) : void;

    public function all();

    public function find(int|string $id);

    public function findWhere(string $column, mixed $value);

    public function findWhereFirst(string $column, mixed $value);

    public function pluck(string $column, string $key = 'id');

    public function paginate(int $perPage = 10);

    public function with(array $data);

    public function load(array $data);

    public function create(array $data);

    public function update(int|string $id, array $data);

    public function delete(int|string $id);
}
