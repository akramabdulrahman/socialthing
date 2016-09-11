<?php

namespace App\Http\Controllers;

use App\Models\Social\Comment;
use App\Models\Social\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class UserTimeLineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', [
            'user' => $user,
            'posts' => $user->posts()->latest()->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $input['user_id']=Auth::user()->id;
        $post = Post::create(($input));
        $post->image=$input['image'];
        $post->video=$input['video'];
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeOnPost(Request $request)
    {
        $input = $request->all();
        $post = Post::find($input['post_id']);
        $post->touch();
        $comment = new Comment();
        $comment->content = $input['content'];
        $comment->user_id = Auth::user()->id;
        $post->comments()->save($comment);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeOnComment(Request $request)
    {
        $input = $request->all();
        $comment = Comment::find($input['comment_id']);
        $comment->commentable()->touch();
        $reply = new Comment();
        $reply->content = $input['content'];
        $reply->user_id = Auth::user()->id;
        $comment->replies()->save($reply);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
