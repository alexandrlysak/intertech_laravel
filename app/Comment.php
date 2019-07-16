<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    /**
     * @return BelongsTo
     */
    public function getAuthor()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function getPost()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return HasMany
     */
    public function getAnswers() {
        return $this->hasMany(Answer::class, 'comment_id');
    }
}
