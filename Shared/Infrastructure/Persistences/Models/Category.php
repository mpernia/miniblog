<?php

namespace MiniBlog\Shared\Infrastructure\Persistences\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tags()
    {
        return $this->hasManyThrough(Tag::class, Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
