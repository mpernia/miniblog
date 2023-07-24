<?php

namespace MiniBlog\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\Contracts\DataTransferObjectInterface;
use MiniBlog\Shared\Infrastructure\Exceptions\UndefinedMethodException;
use AllowDynamicProperties;

#[AllowDynamicProperties]
class DataTransferObject implements DataTransferObjectInterface
{
    protected $fillable = [];

    public function __construct(array $properties)
    {
        if (empty($this->fillable)) {
            $this->fillable = $this->populate($properties);
        }
        $this->fill($properties);
    }

    public function __isset($name)
    {
        return isset($this->fillable[$name]);
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->fillable, true)) {
            $this->{$name} = $value;
        }
        else {
            throw new UndefinedMethodException($name, get_class($this));
        }
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->fillable as $name){
            $array[$name] = property_exists($this, $name) ? $this->{$name} : null;
        }
        return $array;
    }

    public function notNullToArray(): array
    {
        $array = [];
        foreach ($this->toArray() as $property => $value){
            if (!empty($value)){
                $array[$property] = $value;
            }
        }
        return $array;
    }

    private function fill(array $properties): void
    {
        foreach ($properties as $key => $value){
            if (in_array($key, $this->fillable, true)) {
                $this->{$key} = $value ?? null;
            }
        }
    }

    private function populate(array $properties) : array
    {
        $keys = [];
        foreach ($properties as $key => $value) {
            $keys[] = $key;
            if (is_array($value)) {
                $childs = $this->populate($value);
                foreach ($childs as $child) {
                    $keys[][$key] = $child;
                }
            }
        }
        return $keys;
    }
}
