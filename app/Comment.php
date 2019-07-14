<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * @return BelongsTo
     */
    public function getAuthor()
    {
        return $this->belongsTo(User::class);
    }

    public function getPost()
    {
        return $this->belongsTo(Post::class);
    }
}
