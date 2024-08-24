<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, UUIDAsPrimaryKey;

    protected $guarded = ['id'];

    public function image(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function like(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
