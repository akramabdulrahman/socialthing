<?php

namespace App\Models\Social;

use App\Models\Media;
use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CreatedByUser;

    protected $appends = array('image', 'video');

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function getImageAttribute()
    {

        return $this->media()->image()->get();
    }

    public function getVideoAttribute()
    {
        return $this->media()->where('media_type', '=', Media::VIDEO)->first();
    }
}
