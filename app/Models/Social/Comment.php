<?php

namespace App\Models\Social;

use App\Models\Traits\CreatedByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    use CreatedByUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content'];


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
        return $this->morphMany(Comment::class, 'commentable');
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
            $builder->with('replies');
        });
    }
}
