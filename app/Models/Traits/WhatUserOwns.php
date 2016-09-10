<?php
/**
 * Created by PhpStorm.
 * User: akram
 * Date: 9/10/2016
 * Time: 4:45 PM
 */

namespace app\Models\Traits;


use App\Models\Social\Comment;
use App\Models\Social\Post;

trait WhatUserOwns
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}