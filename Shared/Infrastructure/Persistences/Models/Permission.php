<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public $table = 'permissions';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
    ];
}
