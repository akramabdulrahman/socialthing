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
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEach_Comment_can_have_replies()
    {

        self::$user = factory(App\User::class, 1)->create();
        $post = factory(\App\Models\Social\Post::class, 1)->create();
        factory(\App\Models\Social\Comment::class, 10)->make()->each(function ($c) use ($post) {
            $post->comments()->save($c);
            factory(\App\Models\Social\Comment::class,10)->make()->each(function($r) use ($c){
                $c->replies()->save($r);
            });
        });



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
