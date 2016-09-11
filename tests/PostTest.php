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
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser_has_Posts()
    {
        self::$user = factory(App\User::class, 1)->create();
        self::$posts = factory(\App\Models\Social\Post::class, 6)->create();
        self::assertEquals(6, self::$user->posts()->get()->count());
    }

    public function testTextual_Posts()
    {
        self::$user = factory(App\User::class, 1)->create();
        self::$posts = factory(\App\Models\Social\Post::class, 6)->create();
        self::assertInternalType("string", self::$posts[0]->content);
    }

    public function testPhoto_Posts()
    {
        self::$user = factory(App\User::class, 1)->create();
        $post = factory(\App\Models\Social\Post::class, 1)->create();
        $media = factory(\App\Models\Media::class, 'image', 5)->create(['post_id'=>$post->id]);

        $posts = \App\Models\Social\Post::with('media')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->media);
            self::assertNotEmpty($p->image);
            self::assertInstanceOf(\App\Models\Media::class, $p->image[0]);
        }
    }

    public function testVideo_Posts()
    {

        self::$user = factory(App\User::class, 1)->create();
        $post = factory(\App\Models\Social\Post::class, 1)->create();
        $media = factory(\App\Models\Media::class, 'video', 5)->create(['post_id'=>$post->id]);

        $posts = \App\Models\Social\Post::with('media')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->media);
            self::assertNotEmpty($p->video);
            self::assertInstanceOf(\App\Models\Media::class, $p->video[0]);
        }
    }

    public function testEach_Post_has_comments()
    {
        self::$user = factory(App\User::class, 1)->create();
        $post = factory(\App\Models\Social\Post::class, 1)->create();
        $comments = factory(\App\Models\Social\Comment::class, 10)->make()->each(function ($c) use ($post){
                $post->comments()->save($c);
        });

        $posts = Post::with('comments')->get();
        foreach ($posts as $p) {
            self::assertNotEmpty($p->toArray());
            self::assertInstanceOf(Post::class, $p);
            self::assertNotEmpty($p->comments);

            self::assertInstanceOf(\App\Models\Social\Comment::class, $p->comments[0]);
            self::assertInstanceOf(\App\Models\Social\Post::class, $p->comments[0]->commentable()->first());
        }
    }
}
