<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public $table = 'roles';
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
