<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'tags';
    public $timestamps = false;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
