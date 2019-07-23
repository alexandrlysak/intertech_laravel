<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function getPosts(){
        return $this->belongsToMany(Post::class);
    }
}
