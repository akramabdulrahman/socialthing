<?php

namespace App\Models\Social;

use App\Models\Media;
use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use CreatedByUser;

    protected $appends = array('image', 'video');
    protected $fillable = ['content','user_id'];
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
        return $this->media()->video()->get();

    }

    public function setImageAttribute($url)
    {

        $media =  new  Media();
        $media->url = $url ;
        $media->media_type = Media::IMAGE;
        $media->post()->associate($this);
        $media->save();
        return $media;
    }

    public function setVideoAttribute($url)
    {
        $media =  new  Media();
        $media->url = $url ;
        $media->media_type = Media::VIDEO;
        $media->post()->associate($this);
        $media->save();
        return $media;

    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function (Builder $builder) {
            $builder->with('comments');
        });
    }
}
