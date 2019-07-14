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
    public function getAuthor()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function getComments() {
        return $this->hasMany(Comment::class, 'post_id');
    }


    /**
     * @return BelongsToMany
     */
    public function getTags() {
        return $this->belongsToMany(Tag::class);
    }
}
