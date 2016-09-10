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
    protected static $post;
    protected static $media;

    public function setUp()
    {
        parent::setUp();

        $this->runDatabaseMigrations();

        if (is_null(self::$user)) {
            self::$user = factory(App\User::class, 1)->create();
            self::$posts = factory(\App\Models\Social\Post::class, 6)->create();
            self::$post = self::$posts[1];
            self::$media =  factory(App\Models\Media::class, 'image', 3)->create();
            foreach(self::$media as $m){
                $m->post()->associate(self::$post)->save();
            }

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
        self::assertEquals(3,self::$media->count());
        self::assertEquals(self::$post->id,
           self::$media[0]->post_id);

        self::assertEquals(3, self::$posts[1]->media()->get()->count());

    }

    public function testVideo_Posts()
    {

    }

    public function testEach_Post_has_comments()
    {

    }
}
