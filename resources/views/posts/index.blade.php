@foreach($posts as $post)

    @include('posts.show',['post'=>$post])
    @include('posts.comments',['post'=>$post])

@endforeach
{{$posts->links()}}