<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use MiniBlog\Shared\Domain\Contracts\RepositoryInterface;
use MiniBlog\Shared\Infrastructure\Exceptions\ModelNotDefinedException;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    protected function getModelClass()
    {
        if (!method_exists($this, 'setModel'))
        {
            throw new ModelNotDefinedException("No model defined");
        }

        return app()->make($this->setModel());
    }

    protected function hasNameWhere(string $where): bool
    {
        return method_exists($this, $where);
    }

    public function table()
    {
        return $this->model->table;
    }

    public function query()
    {
        return $this->model->query();
    }

    public static function sqlRaw(string $query) : array
    {
        return DB::select($query);
    }

    public function sync(int $id, array $ids, string $related, string $relatedKey, string $foreignKey) : void
    {
        DB::delete("DELETE * FROM {$related} WHERE {$foreignKey} = {$id}");
        $values = stringCouples($id, $ids);
        DB::insert("INSERT INTO {$related} ({$relatedKey}, {$foreignKey}) VALUES {$values}");
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWhere(string $column, mixed $value)
    {
        return $this->model->where($column, $value)->get();
    }

    public function findWhereFirst(string $column, mixed $value)
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function pluck(string $column, string $key = 'id')
    {
        return $this->model->pluck($column, $key);
    }

    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function with(array $data)
    {
        return $this->model->with($data);
    }

    public function load(array $data)
    {
        return $this->model->load($data);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}
