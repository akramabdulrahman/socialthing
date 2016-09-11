<?php

namespace App\Models;

use App\Models\Social\Post;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const  IMAGE = "image";
    const  VIDEO = "video";

    protected $fillable = ['url','media_type'];

    public function post()
    {
        return $this->belongsTo(Post::class,"post_id");
    }

    public function scopeImage($query)
    {
        return $query->where('media_type', '=', self::IMAGE);
    }

    public function scopeVideo($query)
    {
        return $query->where('media_type', '=', self::VIDEO);
    }
}
