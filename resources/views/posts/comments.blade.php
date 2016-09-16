<div class="container">
    <div class="row">
        <div class="col-md-8">
            <span class="text-left list-group-item-text">Comments</span>
            <section class="comment-list">
            @foreach($post->comments as $comment)
                <!-- First Comment -->
                    <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img class="img-responsive"
                                     src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg"/>
                                <figcaption class="text-center">username</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body" data-comment-id="{{$comment->id}}"
                                     data-post-id="{{$post->id}}">
                                    <header class="text-left">
                                        <div class="comment-user"><i
                                                    class="fa fa-user"></i> {{$comment->user()->first()->name}}
                                        </div>
                                        <time class="comment-date" datetime="{{$comment->created_at}}"><i
                                                    class="fa fa-clock-o"></i>
                                            {{$comment->created_at->diffForHumans()}}
                                        </time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                            {{$comment->content}}
                                        </p>
                                    </div>
                                    <p class="text-right"><a href="#reply_comment_{{$comment->id}}"
                                                             class="btn btn-default btn-sm"><i
                                                    class="fa fa-reply"></i> reply</a></p>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="row replies">
                    @foreach($comment->replies as $reply)
                        <!-- Second Comment Reply -->
                            <article class="row">
                                <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                                    <figure class="thumbnail">
                                        <img class="img-responsive"
                                             src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg"/>
                                        <figcaption class="text-center">username</figcaption>
                                    </figure>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="panel panel-default arrow left">
                                        <div class="panel-heading right">Reply</div>
                                        <div class="panel-body" data-comment-id="{{$comment->id}}"
                                             data-reply-id="{{$reply->id}}">
                                            <header class="text-left">
                                                <div class="comment-user"><i
                                                            class="fa fa-user"></i> {{$reply->user()->first()->name}}
                                                </div>
                                                <time class="comment-date" datetime="{{$reply->created_at}}"><i
                                                            class="fa fa-clock-o"></i> {{$reply->created_at->diffForHumans()}}
                                                </time>
                                            </header>
                                            <div class="comment-post">

                                                <p>
                                                    {{$reply->content}}
                                                </p>
                                            </div>
                                            <p class="text-right"><a href="#reply_comment_{{$comment->id}}"
                                                                     class="btn btn-default btn-sm"><i
                                                            class="fa fa-reply"></i> reply</a></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Reply form -->
                        @endforeach
                        <a id="reply_comment_{{$comment->id}}"></a>
                        @include('replies.create')
                    </div>

            @endforeach
            <!-- Comment form -->
                @include('comments.create')

            </section>
        </div>
    </div>
</div>