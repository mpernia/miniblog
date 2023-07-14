<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface RepositoryInterface
{
    public static function sqlRaw(string $sql, array $params = []): array;

    public function all();

    public function find(int $id);

    public function findWhere($column, $value);

    public function findWhereFirst($column, $value);

    public function paginate(int $perPage = 10);

    public function with(array $data);

    public function load(array $data);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
