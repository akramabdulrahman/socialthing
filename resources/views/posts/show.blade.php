<div class="container " style="margin-left: -75px;">
    <div class="row pull-left">
        <div class="col-md-10">
            <div class="col-sm-12"></div>
            <article class="row">
                <div class="col-md-2 col-sm-2 hidden-xs">
                    <figure class="thumbnail">
                        <img class="img-responsive"
                             src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg"/>
                        <figcaption class="text-center">username</figcaption>
                    </figure>
                </div>
                <div class="col-md-10 ">
                    <div class="panel panel-default arrow left">
                        <div class="panel-body" data-post-id="{{$post->id}}">
                            <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i> {{$post->user()->first()->name}}
                                </div>
                                <time class="comment-date" datetime="{{$post->created_at}}"><i
                                            class="fa fa-clock-o"></i>Created {{$post->created_at->diffForHumans()}}</time>

                                <time class="comment-date" datetime="{{$post->updated_at}}"><i
                                            class="fa fa-clock-o"></i>Updated {{$post->updated_at->diffForHumans()}}</time>
                            </header>
                            <div class="comment-post">
                                <div class="row">
                                    @if(isset($post->image[0]))
                                        @include('media.image',['image'=>$post->image[0]])
                                    @endif
                                    @if(isset($post->video[0]))

                                        @include('media.video',['video'=>$post->video[0]])
                                    @endif
                                </div>
                                <p>
                                    {{$post->content}}
                                </p>
                            </div>
                            <p class="text-right"><a href="#comment_post_{{$post->id}}"
                                                     class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Comment</a>
                            </p>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </div>
</div>