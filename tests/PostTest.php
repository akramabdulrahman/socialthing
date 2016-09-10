<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Social\Post;

class PostTest extends TestCase
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
                });
            });



        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser_has_Posts()
    {
        self::assertEquals(6, self::$user->posts()->get()->count());
    }

    public function testTextual_Posts()
    {
        self::assertInternalType("string", self::$posts[0]->content);
    }

    public function testPhoto_Posts()
    {
        $posts = \App\Models\Social\Post::with('media')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->media);
            self::assertNotEmpty($p->image);
            self::assertInstanceOf(\App\Models\Media::class, $p->image);
        }
    }

    public function testVideo_Posts()
    {
        $posts = \App\Models\Social\Post::with('media')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->media);
            self::assertNotEmpty($p->video);
            self::assertInstanceOf(\App\Models\Media::class, $p->video);
        }
    }

    public function testEach_Post_has_comments()
    {
        $posts = Post::with('comments')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->comments);

            self::assertInstanceOf(\App\Models\Social\Comment::class, $p->comments);
            self::assertInstanceOf(\App\Models\Social\Post::class, $p->comments[0]->commentable());
        }
    }
}
