<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * @return HasMany
     */
    public function getPosts() {
        return $this->hasMany(Post::class, 'category_id');
    }
}
