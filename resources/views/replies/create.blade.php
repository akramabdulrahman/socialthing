<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="widget-area no-padding blank">
                <div class="reply-upload">
                    <form action="{{route('comment_on_comment')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <textarea placeholder="What are you doing right now?" name="content"></textarea>
                        <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Reply</button>
                    </form>
                </div><!-- Status Upload  -->
            </div><!-- Widget Area -->
        </div>

    </div>
</div>