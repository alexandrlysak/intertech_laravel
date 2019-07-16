<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function getAuthor()
    {
        return $this->belongsTo(User::class);
    }

    public function getComment()
    {
        return $this->belongsTo(Comment::class);
    }
}
