<?php

namespace App\Models\Social;

use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CreatedByUser;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function post()
    {
        return $this->morphTo(Post::class);
    }

    public function comment()
    {
        return $this->morphTo(Comment::class);
    }

    public function replies()
    {
        return $this->morphMany(Comment::class,'commentable');
    }


}
