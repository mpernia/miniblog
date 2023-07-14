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

    protected function hasNameWhere($where): bool
    {
        return method_exists($this, $where);
    }

    public function table()
    {
        return $this->model->table;
    }

    public static function sqlRaw(string $sql, array $params = []): array
    {
        return DB::select($sql, $params);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWhere($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    public function findWhereFirst($column, $value)
    {
        return $this->model->where($column, $value)->firstOrFail();
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
