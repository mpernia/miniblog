<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'roles';
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
