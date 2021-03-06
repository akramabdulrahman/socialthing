<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Social\Post::class, 6)->create()->each(function ($p) {
            factory(\App\Models\Media::class, 'image', 10)->make()->each(function ($m) use ($p) {
                $p->media()->save($m);
            });
            factory(\App\Models\Media::class, 'video', 10)->make()->each(function ($m) use ($p) {
                $p->media()->save($m);
            });
            factory(\App\Models\Social\Comment::class, 10)->make()->each(function ($c) use ($p) {
                $p->comments()->save($c);
                factory(\App\Models\Social\Comment::class,10)->make()->each(function($r) use ($c){
                    $c->replies()->save($r);
                });
            });
        });
    }
}
