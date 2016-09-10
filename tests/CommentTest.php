<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{


    use DatabaseMigrations;

    protected static $user;
    protected static $posts;


    public function setUp()
    {
        parent::setUp();

        $this->runDatabaseMigrations();

        if (is_null(self::$user)) {
            self::$user = factory(App\User::class, 1)->create();
            self::$posts = factory(\App\Models\Social\Post::class, 6)->create()->each(function ($p) {
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEach_Comment_can_have_replies()
    {
        $post =  \App\Models\Social\Post::first();
        $commentsOnPost = $post->comments()->get();

        foreach ($commentsOnPost as $cop) {
            $replies = $cop->replies()->get();
            self::assertInstanceOf(\App\Models\Social\Comment::class, $replies[0]);
            foreach($replies as $rep){
                self::assertInstanceOf(\App\Models\Social\Comment::class, $rep->commentable()->first());
            }
        }

    }


}
