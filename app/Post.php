<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }
    
    /**
     * @return BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

}
