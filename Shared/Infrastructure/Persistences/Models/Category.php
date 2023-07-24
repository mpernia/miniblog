<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'categories';
    public $timestamps = false;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function tags() : HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, Post::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
