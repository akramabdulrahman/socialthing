<div class="container">

    <div class="row">

        <div class="col-md-8">
            <div class="widget-area no-padding blank">
                <div class="status-upload">
                    <form action="{{route('store_post')}}" method="post">
                        {{csrf_field()}}
                        <textarea name="content" placeholder="What are you doing right now?" ></textarea>
                        <input type="hidden" name="video" value="https://www.youtube.com/embed/zgUb4aVf3Oc">
                        <input type="hidden" name="image" value="http://cdn.arstechnica.net/wp-content/uploads/2016/02/5718897981_10faa45ac3_b-640x624.jpg">
                        <ul>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                        </ul>
                        <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
                    </form>
                </div><!-- Status Upload  -->
            </div><!-- Widget Area -->
        </div>

    </div>
</div>