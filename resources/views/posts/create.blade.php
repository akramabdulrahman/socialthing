<div class="container">

    <div class="row">

        <div class="col-md-8">
            <div class="widget-area no-padding blank">
                <div class="status-upload">
                    <form action="{{route('store_post')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <textarea name="content" placeholder="What are you doing right now?"></textarea>


                            <li style="top:10px" class="fileUpload ">

                                <i class="fa fa-video-camera"></i>

                                <input style="width:200px" type="text" name="video" class=""/>

                            </li>
                            <li class="fileUpload ">
                                <a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video">
                                    <i class="fa fa-picture-o"></i>
                                    <input type="file" name="image" class="upload"/>
                                </a>
                            </li>
                        </ul>
                        <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
                    </form>
                </div><!-- Status Upload  -->
            </div><!-- Widget Area -->
        </div>

    </div>
</div>
