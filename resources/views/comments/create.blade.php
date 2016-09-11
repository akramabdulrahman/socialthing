<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="widget-area no-padding blank">
                <div class="reply-upload">
                    <form action="{{action('UserTimeLineController@storeOnPost')}}" method="post">
                        {{csrf_field()}}
                        <a id="comment_post_{{$post->id}}"></a>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <textarea placeholder="Place Your Comment Here !" name="content"></textarea>
                        <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Comment</button>
                    </form>
                </div><!-- Status Upload  -->
            </div><!-- Widget Area -->
        </div>

    </div>
</div>